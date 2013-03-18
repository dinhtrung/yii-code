<?php
/**
 * EUpdateDialog class file.
 *
 * @author Andrew M. <andrew2mar@gmail.com>
 * @copyright Copyright &copy; 2011 Andrew M.
 * @license Licensed under MIT license.
 * @version 1.0
 */

/**
 * EUpdateDialog allows to create/update/delete model entry from JUI Dialog.
 *
 * @author Andrew M. <andrew2mar@gmail.com>
 */
class EUpdateDialog extends CWidget
{
  /**
   * @var int the height of the dialog.
   */
  public $height = 'auto';

  /**
   * @var bool if set to true, the dialog will be resizable.
   */
  public $resizable = false;

  /**
   * @var string the title of the dialog.
   */
  public $title = 'Dialog';

  /**
   * @var int the width of the dialog.
   */
  public $width = 500;

  /**
   * Add the update dialog to current page.
   */
  public function run()
  {
    $this->beginWidget( 'zii.widgets.jui.CJuiDialog', array(
      'id' => 'update-dialog',
      'options' => array(
        'autoOpen' => false,
        'height' => $this->height,
        'modal' => true,
        'resizable' => $this->resizable,
        'title' => $this->title,
        'width' => $this->width,

      ),
    )); ?>
    <div class="update-dialog-content"></div>
    <?php $this->endWidget();

    $assets = Yii::app()->getAssetManager()->publish( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' );
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile( $assets . '/eUpdateDialog.js' );
  }
}
?>