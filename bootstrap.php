<?php

use Kuba9392\Service\Bootstrap;
use Kuba9392\Service\EnvComparingFilesPathsProvider;
use Kuba9392\Service\EnvMainFilePathProvider;
use Kuba9392\Service\File\BasicMultiFileDiffsReaderProvider;
use Kuba9392\Service\Report\BasicReportFactory;
use Kuba9392\Service\Report\BasicReportGeneratorFactory;
use Kuba9392\Service\ReportGeneratorBootstrap;

require_once 'vendor/autoload.php';

$reportGeneratorBootstrap = new ReportGeneratorBootstrap(
    new BasicReportGeneratorFactory(),
    new BasicMultiFileDiffsReaderProvider(),
    new BasicReportFactory()
);

$bootstrap = new Bootstrap(
    new EnvMainFilePathProvider(),
    new EnvComparingFilesPathsProvider(),
    $reportGeneratorBootstrap
);

$bootstrap->run();