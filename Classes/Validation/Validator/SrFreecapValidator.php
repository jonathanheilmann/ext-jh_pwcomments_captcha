<?php
namespace Heilmann\JhPwcommentsCaptcha\Validation\Validator;

use SJBR\SrFreecap\Domain\Repository\WordRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

/***************************************************************
*  Copyright notice
*
*  (c) 2012-2013 Stanislas Rolland <typo3@sjbr.ca>
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
 * Captcha validator modified to use options from ->setOptions
 * Modified by Jonathan Heilmann <mail@jonathan-heilmann.de>
 */
class SrFreecapValidator extends AbstractValidator {

	/**
	 * This contains the supported options, their default values, types and descriptions.
	 *
	 * @var array
	 */
	protected $supportedOptions = array(
		'word' => array('', 'Captcha string', 'string')
	);

	/**
	 * Check the word that was entered against the hashed value
	 * Returns TRUE, if the given property ($word) matches the session captcha value.
	 *
	 * @param string $word: the word that was entered and should be validated
	 * @return boolean TRUE, if the word entered matches the hash value, FALSE if an error occured
	 */
	public function isValid($word) {
		$isValid = FALSE;
		// Overwrite $word if options contains a value
		if ($this->options['word']) {
			$word = $this->options['word'];
		}
		// Get session data
		/** @var ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		/** @var WordRepository $wordRepository */
		$wordRepository = $objectManager->get(WordRepository::class);
		$wordObject = $wordRepository->getWord();
		$wordHash = $wordObject->getWordHash();
		// Check the word hash against the stored hash value
		if (!empty($wordHash) && !empty($word)) {
			if ($wordObject->getHashFunction() == 'md5') {
				// All freeCap words are lowercase.
				// font #4 looks uppercase, but trust me, it's not...
				if (md5(strtolower(utf8_decode($word))) == $wordHash) {
					// Reset freeCap session vars
					// Cannot stress enough how important it is to do this
					// Defeats re-use of known image with spoofed session id
					$wordRepository->cleanUpWord();
					$isValid = TRUE;
				}
			}
		}
		if (!$isValid) {
			$this->addError(LocalizationUtility::translate('tx_pwcomments.validation_error.captcha', 'PwComments'), 9221561048);
		}
		return $isValid;
	}
}
?>