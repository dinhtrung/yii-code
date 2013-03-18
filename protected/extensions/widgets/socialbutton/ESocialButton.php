<?php

/**
 * WSocialButton Class
 * @author Gia Duy (admin@giaduy.info)
 */
class ESocialButton extends CWidget {

    public $type = 'horizontal';
    public $style = 'standard';

    public function init() {
        parent::init();
        Yii::app()->clientScript->registerScriptFile('https://apis.google.com/js/plusone.js');
        Yii::app()->clientScript->registerScriptFile('http://platform.twitter.com/widgets.js');
    }

    public function run() {
        if ($this->type == 'horizontal')
            $this->horizontal();
        if ($this->type == 'vertical')
            $this->vertical();
    }

    public function vertical() {
        ?>

        <?php if($this->style=='standard'):?>
        <table style="width: auto;">
            <tr><td><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a></td></tr>
            <tr><td><g:plusone size="medium"></g:plusone></td></tr>            
        <tr><td><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=220227991326675&amp;xfbml=1"></script><fb:like href="<?php echo $this->getCurrentUrl();?>" send="false" layout="button_count" width="" show_faces="true" font=""></fb:like></td></tr>
        </table>
        <?php endif;?>

        <?php if($this->style=='box'):?>
        <table style="width: auto;">
            <tr><td><a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a></td></tr>
            <tr><td><g:plusone size="tall"></g:plusone></td></tr>            
            <tr><td><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=220227991326675&amp;xfbml=1"></script><fb:like href="<?php echo $this->getCurrentUrl();?>" send="false" layout="box_count" width="" show_faces="true" font=""></fb:like></td></tr>
        </table>
        <?php endif;?>
        <?php

    }

    public function horizontal() {
        ?>

        <?php if($this->style=='standard'):?>
        <table style="width: auto;">
            <tr>                
                <td><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a></td>
                <td><g:plusone size="medium"></g:plusone></td>                
                <td><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=220227991326675&amp;xfbml=1"></script><fb:like href="<?php echo $this->getCurrentUrl();?>" send="false" layout="button_count" width="" show_faces="true" font=""></fb:like></td>
            </tr>
        </table>
        <?php endif;?>

        <?php if($this->style=='box'):?>
        <table style="width: auto;">
            <tr>                
                <td><a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a></td>
                <td><g:plusone size="tall"></g:plusone></td>                
                <td><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=220227991326675&amp;xfbml=1"></script><fb:like href="<?php echo $this->getCurrentUrl();?>" send="false" layout="box_count" width="" show_faces="true" font=""></fb:like></td>
            </tr>
        </table>
        <?php endif;?>

        <?php
    }

    protected function getCurrentUrl()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->request->requestUri;
    }
}