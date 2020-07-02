<?php
 namespace MailPoetVendor\Doctrine\Common\Collections\Expr; if (!defined('ABSPATH')) exit; class ClosureExpressionVisitor extends \MailPoetVendor\Doctrine\Common\Collections\Expr\ExpressionVisitor { public static function getObjectFieldValue($object, $field) { if (\is_array($object)) { return $object[$field]; } $accessors = array('get', 'is'); foreach ($accessors as $accessor) { $accessor .= $field; if (!\method_exists($object, $accessor)) { continue; } return $object->{$accessor}(); } $accessor = $accessors[0] . $field; if (\method_exists($object, '__call')) { return $object->{$accessor}(); } if ($object instanceof \ArrayAccess) { return $object[$field]; } if (isset($object->{$field})) { return $object->{$field}; } $ccField = \preg_replace_callback('/_(.?)/', function ($matches) { return \strtoupper($matches[1]); }, $field); foreach ($accessors as $accessor) { $accessor .= $ccField; if (!\method_exists($object, $accessor)) { continue; } return $object->{$accessor}(); } return $object->{$field}; } public static function sortByField($name, $orientation = 1, \Closure $next = null) { if (!$next) { $next = function () { return 0; }; } return function ($a, $b) use($name, $next, $orientation) { $aValue = \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($a, $name); $bValue = \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($b, $name); if ($aValue === $bValue) { return $next($a, $b); } return ($aValue > $bValue ? 1 : -1) * $orientation; }; } public function walkComparison(\MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison $comparison) { $field = $comparison->getField(); $value = $comparison->getValue()->getValue(); switch ($comparison->getOperator()) { case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::EQ: return function ($object) use($field, $value) { return \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field) === $value; }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::NEQ: return function ($object) use($field, $value) { return \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field) !== $value; }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::LT: return function ($object) use($field, $value) { return \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field) < $value; }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::LTE: return function ($object) use($field, $value) { return \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field) <= $value; }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::GT: return function ($object) use($field, $value) { return \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field) > $value; }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::GTE: return function ($object) use($field, $value) { return \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field) >= $value; }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::IN: return function ($object) use($field, $value) { return \in_array(\MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value); }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::NIN: return function ($object) use($field, $value) { return !\in_array(\MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value); }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::CONTAINS: return function ($object) use($field, $value) { return \false !== \strpos(\MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value); }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::MEMBER_OF: return function ($object) use($field, $value) { $fieldValues = \MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field); if (!\is_array($fieldValues)) { $fieldValues = \iterator_to_array($fieldValues); } return \in_array($value, $fieldValues); }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::STARTS_WITH: return function ($object) use($field, $value) { return 0 === \strpos(\MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field), $value); }; case \MailPoetVendor\Doctrine\Common\Collections\Expr\Comparison::ENDS_WITH: return function ($object) use($field, $value) { return $value === \substr(\MailPoetVendor\Doctrine\Common\Collections\Expr\ClosureExpressionVisitor::getObjectFieldValue($object, $field), -\strlen($value)); }; default: throw new \RuntimeException("Unknown comparison operator: " . $comparison->getOperator()); } } public function walkValue(\MailPoetVendor\Doctrine\Common\Collections\Expr\Value $value) { return $value->getValue(); } public function walkCompositeExpression(\MailPoetVendor\Doctrine\Common\Collections\Expr\CompositeExpression $expr) { $expressionList = array(); foreach ($expr->getExpressionList() as $child) { $expressionList[] = $this->dispatch($child); } switch ($expr->getType()) { case \MailPoetVendor\Doctrine\Common\Collections\Expr\CompositeExpression::TYPE_AND: return $this->andExpressions($expressionList); case \MailPoetVendor\Doctrine\Common\Collections\Expr\CompositeExpression::TYPE_OR: return $this->orExpressions($expressionList); default: throw new \RuntimeException("Unknown composite " . $expr->getType()); } } private function andExpressions($expressions) { return function ($object) use($expressions) { foreach ($expressions as $expression) { if (!$expression($object)) { return \false; } } return \true; }; } private function orExpressions($expressions) { return function ($object) use($expressions) { foreach ($expressions as $expression) { if ($expression($object)) { return \true; } } return \false; }; } } 