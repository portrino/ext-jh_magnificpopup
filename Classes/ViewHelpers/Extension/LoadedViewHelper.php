<?php
namespace Heilmann\JhMagnificpopup\ViewHelpers\Extension;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Claus Due <claus@namelesscoder.net>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

/**
 * ### Extension: Loaded (Condition) ViewHelper
 *
 * Condition to check if an extension is loaded.
 *
 * @author Claus Due <claus@namelesscoder.net>
 * @package Vhs
 * @subpackage ViewHelpers\Extension
 */
class LoadedViewHelper extends AbstractConditionViewHelper
{

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('extensionName', 'string', 'Name of extension that must be loaded in order to evaluate as TRUE, UpperCamelCase', true);
    }

    /**
     * Render method
     *
     * @return string
     */
    public function render()
    {
        $extensionName = $this->arguments['extensionName'];
        $extensionKey = GeneralUtility::camelCaseToLowerCaseUnderscored($extensionName);
        $isLoaded = ExtensionManagementUtility::isLoaded($extensionKey);
        if (true === $isLoaded) {
            return $this->renderThenChild();
        } else {
            return $this->renderElseChild();
        }
    }
}
