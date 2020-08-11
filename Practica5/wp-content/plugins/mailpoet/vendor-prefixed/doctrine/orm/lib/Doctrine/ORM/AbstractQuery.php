<?php
 namespace MailPoetVendor\Doctrine\ORM; if (!defined('ABSPATH')) exit; use MailPoetVendor\Doctrine\Common\Util\ClassUtils; use MailPoetVendor\Doctrine\Common\Collections\Collection; use MailPoetVendor\Doctrine\Common\Collections\ArrayCollection; use MailPoetVendor\Doctrine\ORM\Query\Parameter; use MailPoetVendor\Doctrine\ORM\Cache\QueryCacheKey; use MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile; use MailPoetVendor\Doctrine\ORM\Cache; use MailPoetVendor\Doctrine\ORM\Query\ResultSetMapping; abstract class AbstractQuery { const HYDRATE_OBJECT = 1; const HYDRATE_ARRAY = 2; const HYDRATE_SCALAR = 3; const HYDRATE_SINGLE_SCALAR = 4; const HYDRATE_SIMPLEOBJECT = 5; protected $parameters; protected $_resultSetMapping; protected $_em; protected $_hints = array(); protected $_hydrationMode = self::HYDRATE_OBJECT; protected $_queryCacheProfile; protected $_expireResultCache = \false; protected $_hydrationCacheProfile; protected $cacheable = \false; protected $hasCache = \false; protected $cacheRegion; protected $cacheMode; protected $cacheLogger; protected $lifetime = 0; public function __construct(\MailPoetVendor\Doctrine\ORM\EntityManagerInterface $em) { $this->_em = $em; $this->parameters = new \MailPoetVendor\Doctrine\Common\Collections\ArrayCollection(); $this->_hints = $em->getConfiguration()->getDefaultQueryHints(); $this->hasCache = $this->_em->getConfiguration()->isSecondLevelCacheEnabled(); if ($this->hasCache) { $this->cacheLogger = $em->getConfiguration()->getSecondLevelCacheConfiguration()->getCacheLogger(); } } public function setCacheable($cacheable) { $this->cacheable = (bool) $cacheable; return $this; } public function isCacheable() { return $this->cacheable; } public function setCacheRegion($cacheRegion) { $this->cacheRegion = (string) $cacheRegion; return $this; } public function getCacheRegion() { return $this->cacheRegion; } protected function isCacheEnabled() { return $this->cacheable && $this->hasCache; } public function getLifetime() { return $this->lifetime; } public function setLifetime($lifetime) { $this->lifetime = (int) $lifetime; return $this; } public function getCacheMode() { return $this->cacheMode; } public function setCacheMode($cacheMode) { $this->cacheMode = (int) $cacheMode; return $this; } public abstract function getSQL(); public function getEntityManager() { return $this->_em; } public function free() { $this->parameters = new \MailPoetVendor\Doctrine\Common\Collections\ArrayCollection(); $this->_hints = $this->_em->getConfiguration()->getDefaultQueryHints(); } public function getParameters() { return $this->parameters; } public function getParameter($key) { $filteredParameters = $this->parameters->filter(function (\MailPoetVendor\Doctrine\ORM\Query\Parameter $parameter) use($key) { $parameterName = $parameter->getName(); return $key === $parameterName || (string) $key === (string) $parameterName; }); return !$filteredParameters->isEmpty() ? $filteredParameters->first() : null; } public function setParameters($parameters) { if (\is_array($parameters)) { $parameterCollection = new \MailPoetVendor\Doctrine\Common\Collections\ArrayCollection(); foreach ($parameters as $key => $value) { $parameterCollection->add(new \MailPoetVendor\Doctrine\ORM\Query\Parameter($key, $value)); } $parameters = $parameterCollection; } $this->parameters = $parameters; return $this; } public function setParameter($key, $value, $type = null) { $existingParameter = $this->getParameter($key); if ($existingParameter !== null) { $existingParameter->setValue($value, $type); return $this; } $this->parameters->add(new \MailPoetVendor\Doctrine\ORM\Query\Parameter($key, $value, $type)); return $this; } public function processParameterValue($value) { if (\is_scalar($value)) { return $value; } if ($value instanceof \MailPoetVendor\Doctrine\Common\Collections\Collection) { $value = $value->toArray(); } if (\is_array($value)) { foreach ($value as $key => $paramValue) { $paramValue = $this->processParameterValue($paramValue); $value[$key] = \is_array($paramValue) ? \reset($paramValue) : $paramValue; } return $value; } if (\is_object($value) && $this->_em->getMetadataFactory()->hasMetadataFor(\MailPoetVendor\Doctrine\Common\Util\ClassUtils::getClass($value))) { $value = $this->_em->getUnitOfWork()->getSingleIdentifierValue($value); if ($value === null) { throw \MailPoetVendor\Doctrine\ORM\ORMInvalidArgumentException::invalidIdentifierBindingEntity(); } } if ($value instanceof \MailPoetVendor\Doctrine\ORM\Mapping\ClassMetadata) { return $value->name; } return $value; } public function setResultSetMapping(\MailPoetVendor\Doctrine\ORM\Query\ResultSetMapping $rsm) { $this->translateNamespaces($rsm); $this->_resultSetMapping = $rsm; return $this; } protected function getResultSetMapping() { return $this->_resultSetMapping; } private function translateNamespaces(\MailPoetVendor\Doctrine\ORM\Query\ResultSetMapping $rsm) { $translate = function ($alias) { return $this->_em->getClassMetadata($alias)->getName(); }; $rsm->aliasMap = \array_map($translate, $rsm->aliasMap); $rsm->declaringClasses = \array_map($translate, $rsm->declaringClasses); } public function setHydrationCacheProfile(\MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile $profile = null) { if (!$profile->getResultCacheDriver()) { $resultCacheDriver = $this->_em->getConfiguration()->getHydrationCacheImpl(); $profile = $profile->setResultCacheDriver($resultCacheDriver); } $this->_hydrationCacheProfile = $profile; return $this; } public function getHydrationCacheProfile() { return $this->_hydrationCacheProfile; } public function setResultCacheProfile(\MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile $profile = null) { if ($profile !== null && !$profile->getResultCacheDriver()) { $resultCacheDriver = $this->_em->getConfiguration()->getResultCacheImpl(); $profile = $profile->setResultCacheDriver($resultCacheDriver); } $this->_queryCacheProfile = $profile; return $this; } public function setResultCacheDriver($resultCacheDriver = null) { if ($resultCacheDriver !== null && !$resultCacheDriver instanceof \MailPoetVendor\Doctrine\Common\Cache\Cache) { throw \MailPoetVendor\Doctrine\ORM\ORMException::invalidResultCacheDriver(); } $this->_queryCacheProfile = $this->_queryCacheProfile ? $this->_queryCacheProfile->setResultCacheDriver($resultCacheDriver) : new \MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile(0, null, $resultCacheDriver); return $this; } public function getResultCacheDriver() { if ($this->_queryCacheProfile && $this->_queryCacheProfile->getResultCacheDriver()) { return $this->_queryCacheProfile->getResultCacheDriver(); } return $this->_em->getConfiguration()->getResultCacheImpl(); } public function useResultCache($bool, $lifetime = null, $resultCacheId = null) { if ($bool) { $this->setResultCacheLifetime($lifetime); $this->setResultCacheId($resultCacheId); return $this; } $this->_queryCacheProfile = null; return $this; } public function setResultCacheLifetime($lifetime) { $lifetime = $lifetime !== null ? (int) $lifetime : 0; $this->_queryCacheProfile = $this->_queryCacheProfile ? $this->_queryCacheProfile->setLifetime($lifetime) : new \MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile($lifetime, null, $this->_em->getConfiguration()->getResultCacheImpl()); return $this; } public function getResultCacheLifetime() { return $this->_queryCacheProfile ? $this->_queryCacheProfile->getLifetime() : 0; } public function expireResultCache($expire = \true) { $this->_expireResultCache = $expire; return $this; } public function getExpireResultCache() { return $this->_expireResultCache; } public function getQueryCacheProfile() { return $this->_queryCacheProfile; } public function setFetchMode($class, $assocName, $fetchMode) { if ($fetchMode !== \MailPoetVendor\Doctrine\ORM\Mapping\ClassMetadata::FETCH_EAGER) { $fetchMode = \MailPoetVendor\Doctrine\ORM\Mapping\ClassMetadata::FETCH_LAZY; } $this->_hints['fetchMode'][$class][$assocName] = $fetchMode; return $this; } public function setHydrationMode($hydrationMode) { $this->_hydrationMode = $hydrationMode; return $this; } public function getHydrationMode() { return $this->_hydrationMode; } public function getResult($hydrationMode = self::HYDRATE_OBJECT) { return $this->execute(null, $hydrationMode); } public function getArrayResult() { return $this->execute(null, self::HYDRATE_ARRAY); } public function getScalarResult() { return $this->execute(null, self::HYDRATE_SCALAR); } public function getOneOrNullResult($hydrationMode = null) { try { $result = $this->execute(null, $hydrationMode); } catch (\MailPoetVendor\Doctrine\ORM\NoResultException $e) { return null; } if ($this->_hydrationMode !== self::HYDRATE_SINGLE_SCALAR && !$result) { return null; } if (!\is_array($result)) { return $result; } if (\count($result) > 1) { throw new \MailPoetVendor\Doctrine\ORM\NonUniqueResultException(); } return \array_shift($result); } public function getSingleResult($hydrationMode = null) { $result = $this->execute(null, $hydrationMode); if ($this->_hydrationMode !== self::HYDRATE_SINGLE_SCALAR && !$result) { throw new \MailPoetVendor\Doctrine\ORM\NoResultException(); } if (!\is_array($result)) { return $result; } if (\count($result) > 1) { throw new \MailPoetVendor\Doctrine\ORM\NonUniqueResultException(); } return \array_shift($result); } public function getSingleScalarResult() { return $this->getSingleResult(self::HYDRATE_SINGLE_SCALAR); } public function setHint($name, $value) { $this->_hints[$name] = $value; return $this; } public function getHint($name) { return isset($this->_hints[$name]) ? $this->_hints[$name] : \false; } public function hasHint($name) { return isset($this->_hints[$name]); } public function getHints() { return $this->_hints; } public function iterate($parameters = null, $hydrationMode = null) { if ($hydrationMode !== null) { $this->setHydrationMode($hydrationMode); } if (!empty($parameters)) { $this->setParameters($parameters); } $rsm = $this->getResultSetMapping(); $stmt = $this->_doExecute(); return $this->_em->newHydrator($this->_hydrationMode)->iterate($stmt, $rsm, $this->_hints); } public function execute($parameters = null, $hydrationMode = null) { if ($this->cacheable && $this->isCacheEnabled()) { return $this->executeUsingQueryCache($parameters, $hydrationMode); } return $this->executeIgnoreQueryCache($parameters, $hydrationMode); } private function executeIgnoreQueryCache($parameters = null, $hydrationMode = null) { if ($hydrationMode !== null) { $this->setHydrationMode($hydrationMode); } if (!empty($parameters)) { $this->setParameters($parameters); } $setCacheEntry = function () { }; if ($this->_hydrationCacheProfile !== null) { list($cacheKey, $realCacheKey) = $this->getHydrationCacheId(); $queryCacheProfile = $this->getHydrationCacheProfile(); $cache = $queryCacheProfile->getResultCacheDriver(); $result = $cache->fetch($cacheKey); if (isset($result[$realCacheKey])) { return $result[$realCacheKey]; } if (!$result) { $result = array(); } $setCacheEntry = function ($data) use($cache, $result, $cacheKey, $realCacheKey, $queryCacheProfile) { $result[$realCacheKey] = $data; $cache->save($cacheKey, $result, $queryCacheProfile->getLifetime()); }; } $stmt = $this->_doExecute(); if (\is_numeric($stmt)) { $setCacheEntry($stmt); return $stmt; } $rsm = $this->getResultSetMapping(); $data = $this->_em->newHydrator($this->_hydrationMode)->hydrateAll($stmt, $rsm, $this->_hints); $setCacheEntry($data); return $data; } private function executeUsingQueryCache($parameters = null, $hydrationMode = null) { $rsm = $this->getResultSetMapping(); $queryCache = $this->_em->getCache()->getQueryCache($this->cacheRegion); $queryKey = new \MailPoetVendor\Doctrine\ORM\Cache\QueryCacheKey($this->getHash(), $this->lifetime, $this->cacheMode ?: \MailPoetVendor\Doctrine\ORM\Cache::MODE_NORMAL, $this->getTimestampKey()); $result = $queryCache->get($queryKey, $rsm, $this->_hints); if ($result !== null) { if ($this->cacheLogger) { $this->cacheLogger->queryCacheHit($queryCache->getRegion()->getName(), $queryKey); } return $result; } $result = $this->executeIgnoreQueryCache($parameters, $hydrationMode); $cached = $queryCache->put($queryKey, $rsm, $result, $this->_hints); if ($this->cacheLogger) { $this->cacheLogger->queryCacheMiss($queryCache->getRegion()->getName(), $queryKey); if ($cached) { $this->cacheLogger->queryCachePut($queryCache->getRegion()->getName(), $queryKey); } } return $result; } private function getTimestampKey() { $entityName = \reset($this->_resultSetMapping->aliasMap); if (empty($entityName)) { return null; } $metadata = $this->_em->getClassMetadata($entityName); return new \MailPoetVendor\Doctrine\ORM\Cache\TimestampCacheKey($metadata->rootEntityName); } protected function getHydrationCacheId() { $parameters = array(); foreach ($this->getParameters() as $parameter) { $parameters[$parameter->getName()] = $this->processParameterValue($parameter->getValue()); } $sql = $this->getSQL(); $queryCacheProfile = $this->getHydrationCacheProfile(); $hints = $this->getHints(); $hints['hydrationMode'] = $this->getHydrationMode(); \ksort($hints); return $queryCacheProfile->generateCacheKeys($sql, $parameters, $hints); } public function setResultCacheId($id) { $this->_queryCacheProfile = $this->_queryCacheProfile ? $this->_queryCacheProfile->setCacheKey($id) : new \MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile(0, $id, $this->_em->getConfiguration()->getResultCacheImpl()); return $this; } public function getResultCacheId() { return $this->_queryCacheProfile ? $this->_queryCacheProfile->getCacheKey() : null; } protected abstract function _doExecute(); public function __clone() { $this->parameters = new \MailPoetVendor\Doctrine\Common\Collections\ArrayCollection(); $this->_hints = array(); $this->_hints = $this->_em->getConfiguration()->getDefaultQueryHints(); } protected function getHash() { $query = $this->getSQL(); $hints = $this->getHints(); $params = \array_map(function (\MailPoetVendor\Doctrine\ORM\Query\Parameter $parameter) { if (\is_scalar($value = $parameter->getValue())) { return $value; } return $this->processParameterValue($value); }, $this->parameters->getValues()); \ksort($hints); return \sha1($query . '-' . \serialize($params) . '-' . \serialize($hints)); } } 