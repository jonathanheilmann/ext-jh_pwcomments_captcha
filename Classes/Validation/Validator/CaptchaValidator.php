<?php
namespace Heilmann\JhPwcommentsCaptcha\Validation\Validator;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
/***************************************************************
*  Copyright notice
*
*  (c) 2011-2012 Axel Jung <axel.jung@aoemedia.de>
*  All rights reserved
*
*  This class is a backport of the corresponding class of FLOW3.
*  All credits go to the v5 team.
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

/**
 * Captcha Validator modified to use options from ->setOptions
 * Modified by Jonathan Heilmann <mail@jonathan-heilmann.de>
 *
 * @deprecated It seems that EXT:captcha_viewhelper is not maintained anymore. Support will be dropped two minor versions later
 */
class CaptchaValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

	/**
	 * This contains the supported options, their default values, types and descriptions.
	 *
	 * @var array
	 */
	protected $supportedOptions = array(
		'value' => array('', 'Captcha string', 'string')
	);

	/**
	* Returns TRUE, if the given property ($value) matches the session captcha Value.
	*
	* If at least one error occurred, the result is FALSE.
	*
	* @param mixed $value The value that should be validated
	* @return boolean TRUE if the value is valid, FALSE if an error occured
	*/
	public function isValid($value) {
		// Overwrite $word if options contains a value
		if ($this->options['value']) {
			$value = $this->options['value'];
		}
		$captcha = GeneralUtility::makeInstance('Tx_CaptchaViewhelper_Captcha');
		try {
			if ($value !== $captcha->getTextInSession()) {
				$this->addError(LocalizationUtility::translate('tx_pwcomments.validation_error.captcha', 'PwComments'), 170320111501);
				return FALSE;
			}
		} catch(\Exception $e) {
			GeneralUtility::devLog('captcha error: ' . $e->getMessage (), 'captcha_viewhelper', 2);
			return FALSE;
		}
		return TRUE;
	}
}
?>