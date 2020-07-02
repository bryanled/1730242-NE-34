<?php
 namespace MailPoetVendor\Doctrine\ORM\Mapping; if (!defined('ABSPATH')) exit; class MappingException extends \MailPoetVendor\Doctrine\ORM\ORMException { public static function pathRequired() { return new self("Specifying the paths to your entities is required " . "in the AnnotationDriver to retrieve all class names."); } public static function identifierRequired($entityName) { if (\false !== ($parent = \get_parent_class($entityName))) { return new self(\sprintf('No identifier/primary key specified for Entity "%s" sub class of "%s". Every Entity must have an identifier/primary key.', $entityName, $parent)); } return new self(\sprintf('No identifier/primary key specified for Entity "%s". Every Entity must have an identifier/primary key.', $entityName)); } public static function invalidInheritanceType($entityName, $type) { return new self("The inheritance type '{$type}' specified for '{$entityName}' does not exist."); } public static function generatorNotAllowedWithCompositeId() { return new self("Id generators can't be used with a composite id."); } public static function missingFieldName($entity) { return new self("The field or association mapping misses the 'fieldName' attribute in entity '{$entity}'."); } public static function missingTargetEntity($fieldName) { return new self("The association mapping '{$fieldName}' misses the 'targetEntity' attribute."); } public static function missingSourceEntity($fieldName) { return new self("The association mapping '{$fieldName}' misses the 'sourceEntity' attribute."); } public static function missingEmbeddedClass($fieldName) { return new self("The embed mapping '{$fieldName}' misses the 'class' attribute."); } public static function mappingFileNotFound($entityName, $fileName) { return new self("No mapping file found named '{$fileName}' for class '{$entityName}'."); } public static function invalidOverrideFieldName($className, $fieldName) { return new self("Invalid field override named '{$fieldName}' for class '{$className}'."); } public static function invalidOverrideFieldType($className, $fieldName) { return new self("The column type of attribute '{$fieldName}' on class '{$className}' could not be changed."); } public static function mappingNotFound($className, $fieldName) { return new self("No mapping found for field '{$fieldName}' on class '{$className}'."); } public static function queryNotFound($className, $queryName) { return new self("No query found named '{$queryName}' on class '{$className}'."); } public static function resultMappingNotFound($className, $resultName) { return new self("No result set mapping found named '{$resultName}' on class '{$className}'."); } public static function emptyQueryMapping($entity, $queryName) { return new self('Query named "' . $queryName . '" in "' . $entity . '" could not be empty.'); } public static function nameIsMandatoryForQueryMapping($className) { return new self("Query name on entity class '{$className}' is not defined."); } public static function missingQueryMapping($entity, $queryName) { return new self('Query named "' . $queryName . '" in "' . $entity . ' requires a result class or result set mapping.'); } public static function missingResultSetMappingEntity($entity, $resultName) { return new self('Result set mapping named "' . $resultName . '" in "' . $entity . ' requires a entity class name.'); } public static function missingResultSetMappingFieldName($entity, $resultName) { return new self('Result set mapping named "' . $resultName . '" in "' . $entity . ' requires a field name.'); } public static function nameIsMandatoryForSqlResultSetMapping($className) { return new self("Result set mapping name on entity class '{$className}' is not defined."); } public static function oneToManyRequiresMappedBy($fieldName) { return new self("OneToMany mapping on field '{$fieldName}' requires the 'mappedBy' attribute."); } public static function joinTableRequired($fieldName) { return new self("The mapping of field '{$fieldName}' requires an the 'joinTable' attribute."); } static function missingRequiredOption($field, $expectedOption, $hint = '') { $message = "The mapping of field '{$field}' is invalid: The option '{$expectedOption}' is required."; if (!empty($hint)) { $message .= ' (Hint: ' . $hint . ')'; } return new self($message); } public static function invalidMapping($fieldName) { return new self("The mapping of field '{$fieldName}' is invalid."); } public static function reflectionFailure($entity, \ReflectionException $previousException) { return new self('An error occurred in ' . $entity, 0, $previousException); } public static function joinColumnMustPointToMappedField($className, $joinColumn) { return new self('The column ' . $joinColumn . ' must be mapped to a field in class ' . $className . ' since it is referenced by a join column of another class.'); } public static function classIsNotAValidEntityOrMappedSuperClass($className) { if (\false !== ($parent = \get_parent_class($className))) { return new self(\sprintf('Class "%s" sub class of "%s" is not a valid entity or mapped super class.', $className, $parent)); } return new self(\sprintf('Class "%s" is not a valid entity or mapped super class.', $className)); } public static function propertyTypeIsRequired($className, $propertyName) { return new self("The attribute 'type' is required for the column description of property " . $className . "::\$" . $propertyName . "."); } public static function tableIdGeneratorNotImplemented($className) { return new self("TableIdGenerator is not yet implemented for use with class " . $className); } public static function duplicateFieldMapping($entity, $fieldName) { return new self('Property "' . $fieldName . '" in "' . $entity . '" was already declared, but it must be declared only once'); } public static function duplicateAssociationMapping($entity, $fieldName) { return new self('Property "' . $fieldName . '" in "' . $entity . '" was already declared, but it must be declared only once'); } public static function duplicateQueryMapping($entity, $queryName) { return new self('Query named "' . $queryName . '" in "' . $entity . '" was already declared, but it must be declared only once'); } public static function duplicateResultSetMapping($entity, $resultName) { return new self('Result set mapping named "' . $resultName . '" in "' . $entity . '" was already declared, but it must be declared only once'); } public static function singleIdNotAllowedOnCompositePrimaryKey($entity) { return new self('Single id is not allowed on composite primary key in entity ' . $entity); } public static function unsupportedOptimisticLockingType($entity, $fieldName, $unsupportedType) { return new self('Locking type "' . $unsupportedType . '" (specified in "' . $entity . '", field "' . $fieldName . '") ' . 'is not supported by Doctrine.'); } public static function fileMappingDriversRequireConfiguredDirectoryPath($path = null) { if (!empty($path)) { $path = '[' . $path . ']'; } return new self('File mapping drivers must have a valid directory path, ' . 'however the given path ' . $path . ' seems to be incorrect!'); } public static function invalidClassInDiscriminatorMap($className, $owningClass) { return new self("Entity class '{$className}' used in the discriminator map of class '{$owningClass}' " . "does not exist."); } public static function duplicateDiscriminatorEntry($className, array $entries, array $map) { return new self("The entries " . \implode(', ', $entries) . " in discriminator map of class '" . $className . "' is duplicated. " . "If the discriminator map is automatically generated you have to convert it to an explicit discriminator map now. " . "The entries of the current map are: @DiscriminatorMap({" . \implode(', ', \array_map(function ($a, $b) { return "'{$a}': '{$b}'"; }, \array_keys($map), \array_values($map))) . "})"); } public static function missingDiscriminatorMap($className) { return new self("Entity class '{$className}' is using inheritance but no discriminator map was defined."); } public static function missingDiscriminatorColumn($className) { return new self("Entity class '{$className}' is using inheritance but no discriminator column was defined."); } public static function invalidDiscriminatorColumnType($className, $type) { return new self("Discriminator column type on entity class '{$className}' is not allowed to be '{$type}'. 'string' or 'integer' type variables are suggested!"); } public static function nameIsMandatoryForDiscriminatorColumns($className) { return new self("Discriminator column name on entity class '{$className}' is not defined."); } public static function cannotVersionIdField($className, $fieldName) { return new self("Setting Id field '{$fieldName}' as versionable in entity class '{$className}' is not supported."); } public static function sqlConversionNotAllowedForIdentifiers($className, $fieldName, $type) { return new self("It is not possible to set id field '{$fieldName}' to type '{$type}' in entity class '{$className}'. The type '{$type}' requires conversion SQL which is not allowed for identifiers."); } public static function duplicateColumnName($className, $columnName) { return new self("Duplicate definition of column '" . $columnName . "' on entity '" . $className . "' in a field or discriminator column mapping."); } public static function illegalToManyAssociationOnMappedSuperclass($className, $field) { return new self("It is illegal to put an inverse side one-to-many or many-to-many association on mapped superclass '" . $className . "#" . $field . "'."); } public static function cannotMapCompositePrimaryKeyEntitiesAsForeignId($className, $targetEntity, $targetField) { return new self("It is not possible to map entity '" . $className . "' with a composite primary key " . "as part of the primary key of another entity '" . $targetEntity . "#" . $targetField . "'."); } public static function noSingleAssociationJoinColumnFound($className, $field) { return new self("'{$className}#{$field}' is not an association with a single join column."); } public static function noFieldNameFoundForColumn($className, $column) { return new self("Cannot find a field on '{$className}' that is mapped to column '{$column}'. Either the " . "field does not exist or an association exists but it has multiple join columns."); } public static function illegalOrphanRemovalOnIdentifierAssociation($className, $field) { return new self("The orphan removal option is not allowed on an association that is " . "part of the identifier in '{$className}#{$field}'."); } public static function illegalOrphanRemoval($className, $field) { return new self("Orphan removal is only allowed on one-to-one and one-to-many " . "associations, but " . $className . "#" . $field . " is not."); } public static function illegalInverseIdentifierAssociation($className, $field) { return new self("An inverse association is not allowed to be identifier in '{$className}#{$field}'."); } public static function illegalToManyIdentifierAssociation($className, $field) { return new self("Many-to-many or one-to-many associations are not allowed to be identifier in '{$className}#{$field}'."); } public static function noInheritanceOnMappedSuperClass($className) { return new self("It is not supported to define inheritance information on a mapped superclass '" . $className . "'."); } public static function mappedClassNotPartOfDiscriminatorMap($className, $rootClassName) { return new self("Entity '" . $className . "' has to be part of the discriminator map of '" . $rootClassName . "' " . "to be properly mapped in the inheritance hierarchy. Alternatively you can make '" . $className . "' an abstract class " . "to avoid this exception from occurring."); } public static function lifecycleCallbackMethodNotFound($className, $methodName) { return new self("Entity '" . $className . "' has no method '" . $methodName . "' to be registered as lifecycle callback."); } public static function entityListenerClassNotFound($listenerName, $className) { return new self(\sprintf('Entity Listener "%s" declared on "%s" not found.', $listenerName, $className)); } public static function entityListenerMethodNotFound($listenerName, $methodName, $className) { return new self(\sprintf('Entity Listener "%s" declared on "%s" has no method "%s".', $listenerName, $className, $methodName)); } public static function duplicateEntityListener($listenerName, $methodName, $className) { return new self(\sprintf('Entity Listener "%s#%s()" in "%s" was already declared, but it must be declared only once.', $listenerName, $methodName, $className)); } public static function invalidFetchMode($className, $annotation) { return new self("Entity '" . $className . "' has a mapping with invalid fetch mode '" . $annotation . "'"); } public static function compositeKeyAssignedIdGeneratorRequired($className) { return new self("Entity '" . $className . "' has a composite identifier but uses an ID generator other than manually assigning (Identity, Sequence). This is not supported."); } public static function invalidTargetEntityClass($targetEntity, $sourceEntity, $associationName) { return new self("The target-entity " . $targetEntity . " cannot be found in '" . $sourceEntity . "#" . $associationName . "'."); } public static function invalidCascadeOption(array $cascades, $className, $propertyName) { $cascades = \implode(", ", \array_map(function ($e) { return "'" . $e . "'"; }, $cascades)); return new self(\sprintf("You have specified invalid cascade options for %s::\$%s: %s; available options: 'remove', 'persist', 'refresh', 'merge', and 'detach'", $className, $propertyName, $cascades)); } public static function missingSequenceName($className) { return new self(\sprintf('Missing "sequenceName" attribute for sequence id generator definition on class "%s".', $className)); } public static function infiniteEmbeddableNesting($className, $propertyName) { return new self(\sprintf('Infinite nesting detected for embedded property %s::%s. ' . 'You cannot embed an embeddable from the same type inside an embeddable.', $className, $propertyName)); } } 