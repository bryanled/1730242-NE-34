<?php
 namespace MailPoetVendor\Doctrine\DBAL\Cache; if (!defined('ABSPATH')) exit; use MailPoetVendor\Doctrine\Common\Cache\Cache; class QueryCacheProfile { private $resultCacheDriver; private $lifetime = 0; private $cacheKey; public function __construct($lifetime = 0, $cacheKey = null, \MailPoetVendor\Doctrine\Common\Cache\Cache $resultCache = null) { $this->lifetime = $lifetime; $this->cacheKey = $cacheKey; $this->resultCacheDriver = $resultCache; } public function getResultCacheDriver() { return $this->resultCacheDriver; } public function getLifetime() { return $this->lifetime; } public function getCacheKey() { if ($this->cacheKey === null) { throw \MailPoetVendor\Doctrine\DBAL\Cache\CacheException::noCacheKey(); } return $this->cacheKey; } public function generateCacheKeys($query, $params, $types) { $realCacheKey = $query . "-" . \serialize($params) . "-" . \serialize($types); if ($this->cacheKey === null) { $cacheKey = \sha1($realCacheKey); } else { $cacheKey = $this->cacheKey; } return array($cacheKey, $realCacheKey); } public function setResultCacheDriver(\MailPoetVendor\Doctrine\Common\Cache\Cache $cache) { return new \MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile($this->lifetime, $this->cacheKey, $cache); } public function setCacheKey($cacheKey) { return new \MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile($this->lifetime, $cacheKey, $this->resultCacheDriver); } public function setLifetime($lifetime) { return new \MailPoetVendor\Doctrine\DBAL\Cache\QueryCacheProfile($lifetime, $this->cacheKey, $this->resultCacheDriver); } } 