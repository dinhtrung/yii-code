<?php
/**
 * AsteriskDestinationBehavior class file.
 *
 * @author Jon Doe <jonny@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * AsteriskDestinationBehavior is ...
 *
 *
 * @author Jon Doe <jonny@gmail.com>
 * @version
 * @package
 * @since 1.0
 */

class AsteriskDestinationBehavior extends CActiveRecordBehavior
{

	public $context;
	private $exten;
	public $priority = 1;
	public $keyField = 'id';
	public $app = array();

	/**
	 * Declares events and the corresponding event handler methods.
	 * The events are defined by the {@link owner} component, while the handler
	 * methods by the behavior class. The handlers will be attached to the corresponding
	 * events when the behavior is attached to the {@link owner} component; and they
	 * will be detached from the events when the behavior is detached from the component.
	 * @return array events (array keys) and the corresponding event handler methods (array values).
	 */
	public function events()
	{
		return array();
	}

    /**
     * Logs a message.
     *
     * @param string $message Message to be logged
     * @param string $level Level of the message (e.g. 'trace', 'warning',
     * 'error', 'info', see CLogger constants definitions)
     */
    public static function log($message, $level='error')
    {
        Yii::log($message, $level, 'application');
    }

    /**
     * Dumps a variable or the object itself in terms of a string.
     *
     * @param mixed variable to be dumped
     */
    protected function dump($var='dump-the-object',$highlight=true)
    {
        if ($var === 'dump-the-object') {
            return CVarDumper::dumpAsString($this,$depth=15,$highlight);
        } else {
            return CVarDumper::dumpAsString($var,$depth=15,$highlight);
        }
    }

    public function afterSave($event)  {
    	if (is_null($this->context)) $this->context = TextHelper::utf2ascii(strtolower(get_class($event->sender)), TRUE, '-');
    	$attributes = array(
			"context"	=>	$this->context,
			"exten"		=>	$this->getOwner()->{$this->keyField},
			"priority"	=>	$this->priority,
		);
		$this->log(CVarDumper::dumpAsString($attributes));
		$model = Extensions::model()->findByAttributes($attributes);
		if (is_null($model)) {
			$model = new Extensions();
			$model->setAttributes($attributes);
		}
		$model->app = $this->getOwner()->getApp();
		$model->appdata = $this->getOwner()->getAppData();
		$this->log(CVarDumper::dumpAsString($model->getAttributes()), 'error');
		if (! $model->save()){
			$this->log(CVarDumper::dumpAsString($model->getAttributes()), 'error');
		}
    }

    /**
     * Return the Destination location
     */
    public function getDialplanLocation() {
    	return $this->context . ',' . $this->getOwner()->{$this->keyField} . ',' . $this->priority;
    }
    /**
     * Return the Destination location
     */
    public function getDialplanIdentifier() {
    	return $this->getOwner()->{$this->keyField} . ',' . $this->priority . '@' . $this->context ;
    }
}
