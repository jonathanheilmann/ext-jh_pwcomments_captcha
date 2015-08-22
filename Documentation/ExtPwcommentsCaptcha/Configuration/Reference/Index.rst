

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Reference
^^^^^^^^^

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
         
         - captcha
         
         - sr\_freecap
   
   Default
         {$plugin.tx\_pwcomments.settings.captcha}


.. container:: table-row

   Property
         view.templateRootPath
   
   Data type
         string
   
   Description
         This extension changes the template root path to include the captcha.
   
   Default
         EXT:jh\_pwcomments\_captcha/Resources/Private/Templates/


.. container:: table-row

   Property
         view.partialRootPath
   
   Data type
         string
   
   Description
         This extension changes the partial root path to include the captcha.
   
   Default
         EXT:jh\_pwcomments\_captcha/Resources/Private/Partials/


.. container:: table-row

   Property
         features.rewrittenPropertyMapper
   
   Data type
         boolean
   
   Description
         Do not use the rewrittenPropertyMapper, it would run into an error.
   
   Default
         0


.. ###### END~OF~TABLE ######

[tsref: tx\_pwcomments]

