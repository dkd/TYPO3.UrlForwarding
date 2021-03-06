<?php
defined('TYPO3_MODE') or die();

// Get the icon registry
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

/**
 * Add the icons for record types to the icon registry
 */
$recordTypes = [
    'redirect'
];

foreach ($recordTypes as $recordType) {
    $iconRegistry->registerIcon(
        'mimetypes-x-urlforwarding-' . $recordType,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        [
            'source' => 'EXT:url_forwarding/Resources/Public/Icons/TCA/Redirect/' . $recordType . '.png'
        ]
    );
}

/**
 * Add the icons for redirect types to the icon registry
 */
$typesAmount = 2;

for ($typeNumber = 0; $typeNumber <= $typesAmount; $typeNumber++) {
    $iconRegistry->registerIcon(
        'mimetypes-x-urlforwarding-type-' . $typeNumber,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        [
            'source' => 'EXT:url_forwarding/Resources/Public/Icons/TCA/Redirect/' . $typeNumber . '.png'
        ]
    );
}

// Check url forwarding before page rendering. This is the very first hook in TYPO3
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/index_ts.php']['preprocessRequest']['url_forwarding'] =
    \PatrickBroens\UrlForwarding\Hook\IndexTs::class . '->preprocessRequest';

// Check if a redirect is already available for a domain
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['url_forwarding'] =
    \PatrickBroens\UrlForwarding\Hook\TceMain::class;