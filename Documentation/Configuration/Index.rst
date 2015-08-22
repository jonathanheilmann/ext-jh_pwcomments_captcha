.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _configuration:

Configuration
=============

.. _configuration_reference:

Reference
---------

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         settings.captcha

   Data type
         string

   Description
         Select the captcha.

         Possible values are

         - none

         - captcha (deprecated since version 0.1.0)

         - sr\_freecap

   Default
         {$plugin.tx\_pwcomments.settings.captcha}


.. container:: table-row

   Property
         view.templateRootPaths.200

   Data type
         string

   Description
         Template root path to include the captcha.

   Default
         EXT:jh\_pwcomments\_captcha/Resources/Private/Templates


.. container:: table-row

   Property
         view.partialRootPaths.200

   Data type
         string

   Description
         Partial root path to include the captcha.

   Default
         EXT:jh\_pwcomments\_captcha/Resources/Private/Partials


.. ###### END~OF~TABLE ######

[tsref: tx\_pwcomments]


.. _configuration_translation:

Translation
-----------

This Extension adds some language-labels to pw\_comments. By default a
german translation is included.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:

   Data type
         Data type:

   Description
         Description:

   Default
         Default:


.. container:: table-row

   Property
         tx_pwcomments.validation\_error.captcha

   Data type
         string

   Description
         Captcha validation error

   Default
         Entered word does not match the image.


.. container:: table-row

   Property
         tx_pwcomments.newComment.captcha.label

   Data type
         string

   Description
         Label of captcha input-field

   Default
         Captcha:


.. container:: table-row

   Property
         tx_pwcomments.newComment.captcha.notice

   Data type
         string

   Description
         Notice, displayed as title of captcha input-field

   Default
         Please enter here the word as displayed in the picture.


.. container:: table-row

   Property
         tx_pwcomments.newComment.captcha.explain

   Data type
         string

   Description
         Explanation, displayed as title of captcha input-field

   Default
         This is to prevent spamming.


.. ###### END~OF~TABLE ######

[tsref: tx\_pwcomments.\_LOCAL\_LANG.default]