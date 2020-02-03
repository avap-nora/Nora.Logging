<?php
declare(strict_types=1);
/**
 * This file is a part of Nora\Logging
 *
 * @author Hajime MATSUMOTO
 */
use Doctrine\Common\Annotations\AnnotationRegistry;
$loader = include dirname(__DIR__).'/vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);
