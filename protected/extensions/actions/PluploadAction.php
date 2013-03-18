<?php
/**
 * PluploadAction class file.
 *
 * @author Jon Doe <jonny@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * PluploadAction is ...
 *
 *
 * @author Jon Doe <jonny@gmail.com>
 * @version
 * @package
 * @since 1.0
 */


class PluploadAction extends CAction
{
	/**
	 * Target upload directory
	 * @var string
	 */
	public $targetDir = null;
	/**
	 * Whether to remove old files or not
	 * @var boolean
	 */
	public $cleanup = false;
	/**
	 * Temp file age in seconds
	 * @var int
	 */
    public $fileAge = 3600; // Temp file age in seconds


    public function run()
    {
          header('Content-type: text/plain; charset=UTF-8');
          header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
          header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
          header("Cache-Control: no-store, no-cache, must-revalidate");
          header("Cache-Control: post-check=0, pre-check=0", false);
          header("Pragma: no-cache");
          if (is_null($this->targetDir)) $this->targetDir = isset($_GET["targetDir"]) ? urldecode($_GET["targetDir"]) : sys_get_temp_dir();
			Yii::log("Upload directory: " . $this->targetDir, "trace");
          // 5 minutes execution time
          @set_time_limit(5 * 60);
          // usleep(5000);

          // Get parameters
          $chunk = isset($_REQUEST["chunk"]) ? $_REQUEST["chunk"] : 0;
          $chunks = isset($_REQUEST["chunks"]) ? $_REQUEST["chunks"] : 0;
          $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

          // Clean the fileName for security reasons
          $fileName = preg_replace('/[^\w\._\s]+/', '', $fileName);
           if (!file_exists($this->targetDir))
                  @mkdir($this->targetDir);

          // Remove old temp files
          if (is_dir($this->targetDir) && ($dir = opendir($this->targetDir))) {
                  while (($file = readdir($dir)) !== false) {
                          $filePath = $this->targetDir . DIRECTORY_SEPARATOR . $file;

                          // Remove temp files if they are older than the max age
                          if (preg_match('/\\.tmp$/', $file) && (filemtime($filePath) < time() - $this->fileAge))
                                  @unlink($filePath);
                  }

                  closedir($dir);
          } else
                  throw new CHttpException (500, Yii::t('app', "Can't open temporary directory :dir", array(':dir' => $this->targetDir)));

          // Look for the content type header
          if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
                  $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

          if (isset($_SERVER["CONTENT_TYPE"]))
                  $contentType = $_SERVER["CONTENT_TYPE"];

          if (strpos($contentType, "multipart") !== false) {
                  if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                          // Open temp file
                          $out = fopen($this->targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
                          if ($out) {
                                  // Read binary input stream and append it to temp file
                                  $in = fopen($_FILES['file']['tmp_name'], "rb");

                                  if ($in) {
                                          while ($buff = fread($in, 4096))
                                                  fwrite($out, $buff);
                                  } else
                                          throw new CHttpException (500, Yii::t('app', "Can't open input stream."));

                                  fclose($out);
                                  @unlink($_FILES['file']['tmp_name']);
                          } else
                                  throw new CHttpException (500, Yii::t('app', "Can't open output stream."));
                  } else
                          throw new CHttpException (500, Yii::t('app', "Can't move uploaded file."));
          } else {
                  // Open temp file
                  $out = fopen($this->targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
                  if ($out) {
                          // Read binary input stream and append it to temp file
                          $in = fopen("php://input", "rb");

                          if ($in) {
                                  while ($buff = fread($in, 4096))
                                          fwrite($out, $buff);
                          } else
                                  throw new CHttpException (500, Yii::t('app', "Can't open input stream."));

                          fclose($out);
                  } else
                          throw new CHttpException (500, Yii::t('app', "Can't open output stream."));
          }

          // After last chunk is received, process the file
          $ret = array('result' => '1');
          if (intval($chunk) + 1 >= intval($chunks)) {

              $originalname = $fileName;
              if (isset($_SERVER['HTTP_CONTENT_DISPOSITION'])) {
                  $arr = array();
                  preg_match('@^attachment; filename="([^"]+)"@',$_SERVER['HTTP_CONTENT_DISPOSITION'],$arr);
                  if (isset($arr[1]))
                      $originalname = $arr[1];
              }

              // **********************************************************************************************
              // Do whatever you need with the uploaded file, which has $originalname as the original file name
              // and is located at $this->targetDir . DIRECTORY_SEPARATOR . $fileName
              // **********************************************************************************************
          }

          // Return response
          die(json_encode($ret));
    }
}