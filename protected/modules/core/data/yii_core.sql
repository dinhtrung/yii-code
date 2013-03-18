-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 11, 2011 at 06:43 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `alias`, `description`, `body`, `createtime`, `updatetime`, `uid`, `cid`, `tags`) VALUES
(1, 'Using File Image Behavior', '', '\r\n	Yii File v&agrave; Image AR Behavior cho ph&eacute;p li&ecirc;n kết c&aacute;c b&agrave;i viết tự động với c&aacute;c file v&agrave; ảnh minh họa một c&aacute;ch tương đối dễ d&agrave;ng.\r\n\r\n	Phần dưới đ&acirc;y tr&igrave;nh b&agrave;y c&aacute;ch sử d', '<p>\r\n	Yii File v&agrave; Image AR Behavior cho ph&eacute;p li&ecirc;n kết c&aacute;c b&agrave;i viết tự động với c&aacute;c file v&agrave; ảnh minh họa một c&aacute;ch tương đối dễ d&agrave;ng.</p>\r\n<p>\r\n	Phần dưới đ&acirc;y tr&igrave;nh b&agrave;y c&aacute;ch sử dụng ch&uacute;ng.</p>\r\n<h3>\r\n	FileARBehavior</h3>\r\n<p>\r\n	Trong v&iacute; dụ dưới đ&acirc;y, mỗi 1 m&oacute;n ăn tương ứng với 1 file chứa c&ocirc;ng thức nấu ăn:</p>\r\n<h4>\r\n	Th&ecirc;m Behavior v&agrave;o Model</h4>\r\n<pre>\r\n/** @file Dish.php*/\r\nclass Dish extends CActiveRecord {\r\n    public $recipe; // used by the form to send the file.\r\n\r\n    public function rules()\r\n    {\r\n        return array(\r\n            // ...\r\n            // for the form too\r\n            array(&#39;recipe&#39;, &#39;file&#39;, &#39;types&#39; =&gt; &#39;pdf, txt&#39;),\r\n            // ...\r\n        );\r\n    }\r\n\r\n    public function behaviors() {\r\n        return array(\r\n            &#39;recipeBehavior&#39; =&gt; array(\r\n                &#39;class&#39; =&gt; &#39;FileARBehavior&#39;,\r\n                &#39;attribute&#39; =&gt; &#39;recipe&#39;, // this must exist\r\n                &#39;extension&#39; =&gt; &#39;pdf, txt&#39;, // possible extensions, comma separated\r\n                &#39;prefix&#39; =&gt; &#39;recipe_&#39;, // if you want a prefix\r\n                &#39;relativeWebRootFolder&#39; =&gt; &#39;files/recipes&#39;, // this folder must exist\r\n                //&#39;defaultName&#39; =&gt; &#39;default&#39;, // you can also use a default file (see Ingredients with image below).\r\n            )\r\n        );\r\n    }\r\n}\r\n</pre>\r\n<h4>\r\n	Th&ecirc;m trường v&agrave;o Form</h4>\r\n<pre>\r\n$form=$this-&gt;beginWidget(&#39;CActiveForm&#39;, array(\r\n    // ...\r\n    &#39;htmlOptions&#39; =&gt; array(&#39;enctype&#39;=&gt;&#39;multipart/form-data&#39;), // don&#39;t forget this option\r\n));\r\n\r\necho $form-&gt;fileField($model,&#39;recipe&#39;);</pre>\r\n<h4>\r\n	Lấy dữ liệu về file đ&iacute;nh k&egrave;m</h4>\r\n<pre>\r\n$model-&gt;recipeBehavior-&gt;getFileUrl();\r\n$model-&gt;recipeBehavior-&gt;getFilePath();\r\n</pre>\r\n<h3>\r\n	ImageARBehavior</h3>\r\n<p>\r\n	Thay đổi lại cấu h&igrave;nh cho Behavior trong model:</p>\r\n<pre>\r\n    public function rules()\r\n\r\n    {\r\n        return array(\r\n            // ...\r\n            // for the form too\r\n            array(&#39;recipeImg&#39;, &#39;file&#39;, &#39;types&#39; =&gt; &#39;png, gif, jpg&#39;, &#39;allowEmpty&#39; =&gt; true),\r\n            // ...\r\n        );\r\n    }\r\n\r\n    public function behaviors() {\r\n        return array(\r\n            &#39;recipeImgBehavior&#39; =&gt; array(\r\n                &#39;class&#39; =&gt; &#39;ImageARBehavior&#39;,\r\n                &#39;attribute&#39; =&gt; &#39;recipeImg&#39;, // this must exist\r\n                &#39;extension&#39; =&gt; &#39;png, gif, jpg&#39;, // possible extensions, comma separated\r\n                &#39;prefix&#39; =&gt; &#39;img_&#39;,\r\n                &#39;relativeWebRootFolder&#39; =&gt; &#39;files/recipes&#39;, // this folder must exist\r\n\r\n                # &#39;forceExt&#39; =&gt; png, // this is the default, every saved image will be a png one.\r\n                # Set to null if you want to keep the original format\r\n\r\n                &#39;useImageMagick&#39; =&gt; &#39;/usr/bin&#39;, # I want to use imagemagick instead of GD, and\r\n                # it is located in /usr/bin on my computer.\r\n\r\n                // this will define formats for the image.\r\n                // The format &#39;normal&#39; always exist. This is the default format, by default no\r\n                // suffix or no processing is enabled.\r\n                &#39;formats&#39; =&gt; array(\r\n                    // create a thumbnail grayscale format\r\n                    &#39;thumb&#39; =&gt; array(\r\n                        &#39;suffix&#39; =&gt; &#39;_thumb&#39;,\r\n                        &#39;process&#39; =&gt; array(&#39;resize&#39; =&gt; array(60, 60), &#39;grayscale&#39; =&gt; true),\r\n                    ),\r\n                    // create a large one (in fact, no resize is applied)\r\n                    &#39;large&#39; =&gt; array(\r\n                        &#39;suffix&#39; =&gt; &#39;_large&#39;,\r\n                    ),\r\n                    // and override the default :\r\n                    &#39;normal&#39; =&gt; array(\r\n                        &#39;process&#39; =&gt; array(&#39;resize&#39; =&gt; array(200, 200)),\r\n                    ),\r\n                ),\r\n\r\n                &#39;defaultName&#39; =&gt; &#39;default&#39;, // when no file is associated, this one is used by getFileUrl\r\n                // defaultName need to exist in the relativeWebRootFolder path, and prefixed by prefix,\r\n                // and with one of the possible extensions. if multiple formats are used, a default file must exist\r\n                // for each format. Name is constructed like this :\r\n                //     {prefix}{name of the default file}{suffix}{one of the extension}\r\n            )\r\n        );\r\n    }\r\n</pre>\r\n<h4>\r\n	Truy xuất dữ liệu</h4>\r\n<pre>\r\n$format = &#39;normal&#39;; // for this example you can use &#39;large&#39; or &#39;thumb&#39;\r\n$fileUrl = $model-&gt;recipeImgBehavior-&gt;getFileUrl($format);\r\n$filePath = $model-&gt;recipeBehavior-&gt;getFilePath($format);\r\n$allPaths = $model-&gt;recipeBehavior-&gt;getFilesPath();</pre>\r\n<h3>\r\n	FileARBehavior với h&agrave;m Processor</h3>\r\n<p>\r\n	Viết 1 lớp Processor v&agrave; đặt trong <em>extensions/processors/</em></p>\r\n<pre>\r\nclass MyProcessor {\r\n    private $_content\r\n    // constructor must take an argument\r\n    public function __construct($srcPath) {\r\n        $this-&gt;_content = file_get_contents($srcPath);\r\n    }\r\n\r\n    public function myProcessFunc1() {\r\n        // do something with $this-&gt;_content ...\r\n    }\r\n\r\n    public function myProcessFunc2($param1, $param2) {\r\n        // do something with $this-&gt;_content  and params ...\r\n    }\r\n\r\n    // this function must exist\r\n    public function save($outPath) {\r\n        file_put_contents($outPath, $this-&gt;_content);\r\n    }\r\n}</pre>\r\n<p>\r\n	Nh&uacute;ng Processor v&agrave;o trong Behavior</p>\r\n<pre>\r\n    public function behaviors() {\r\n        return array(\r\n            &#39;myBehavior&#39; =&gt; array(\r\n                &#39;class&#39; =&gt; &#39;FileARBehavior&#39;,\r\n                &#39;attribute&#39; =&gt; &#39;myAttr&#39;,\r\n                &#39;extension&#39; =&gt; &#39;txt&#39;,\r\n                &#39;relativeWebRootFolder&#39; =&gt; &#39;files/myPath&#39;,\r\n\r\n                &#39;processor&#39; =&gt; &#39;ext.processors.MyProcessor&#39;\r\n\r\n                // this will create two files per model\r\n                &#39;formats&#39; =&gt; array(\r\n                    &#39;test&#39; =&gt; array(\r\n                        &#39;process&#39; =&gt; array(\r\n                            &#39;myProcessFunc1&#39; =&gt; true,\r\n                        ),\r\n                    ),\r\n                    // and override the default :\r\n                    &#39;normal&#39; =&gt; array(\r\n                        &#39;process&#39; =&gt; array(\r\n                            // myProcessFunc2 will be called before myProcessFunc1 when saving\r\n                            &#39;myProcessFunc2&#39; =&gt; array(200, 200),\r\n                            &#39;myProcessFunc1&#39; =&gt; true,\r\n                        ),\r\n                    ),\r\n                ),\r\n\r\n                // or, if you only want one file but processed, override only normal:\r\n                //&#39;formats&#39; =&gt; array(\r\n                //    &#39;normal&#39; =&gt; array(\r\n                //        &#39;process&#39; =&gt; array(\r\n                //            // myProcessFunc2 will be called before myProcessFunc1 when saving\r\n                //            &#39;myProcessFunc2&#39; =&gt; array(200, 200),\r\n                //            &#39;myProcessFunc1&#39; =&gt; true,\r\n                //        ),\r\n                //    ),\r\n                //),\r\n            )\r\n        );\r\n    }</pre>\r\n<p>\r\n	&nbsp;</p>\r\n', 1309886792, 1309887087, 1, 2, 'processor, file, image, behavior'),
(2, 'Arraymodel', '', '\r\n	Giới thiệu\r\n\r\n	Đ&ocirc;i khi n&oacute; c&oacute; thể c&oacute; &iacute;ch để đưa dữ liệu tĩnh v&agrave;o một mảng kết hợp tr&ecirc;n hệ thống tập tin thay v&igrave; v&agrave;o cơ sở dữ liệu. Điều n&agrave;y c&oacute; thể bao gồm một số loại dữ liệu cấu', '<h2 id="hh0">\r\n	Giới thiệu</h2>\r\n<p>\r\n	Đ&ocirc;i khi n&oacute; c&oacute; thể c&oacute; &iacute;ch để đưa dữ liệu tĩnh v&agrave;o một mảng kết hợp tr&ecirc;n hệ thống tập tin thay v&igrave; v&agrave;o cơ sở dữ liệu. Điều n&agrave;y c&oacute; thể bao gồm một số loại dữ liệu cấu h&igrave;nh m&agrave; cần phải được nạp mỗi lần hoặc lặp đi lặp lại dữ liệu tĩnh, như c&aacute;c th&agrave;nh phố, quốc gia, v&ugrave;ng, tỉnh, vv Thật kh&ocirc;ng may, trong Yii kh&ocirc;ng c&oacute; loại m&ocirc; h&igrave;nh để truy cập v&agrave; / hoặc thao t&aacute;c n&agrave;y loại dữ liệu . Tại thời điểm n&agrave;y, EArrayModel đến in</p>\r\n<h2 id="hh1">\r\n	C&aacute;ch sử dụng</h2>\r\n<p>\r\n	EArrayModel đ&atilde; được thiết kế theo c&aacute;ch như vậy m&agrave; cấu tr&uacute;c của lớp học l&agrave; gần như ch&iacute;nh x&aacute;c giống như CActiveRecord, trừ c&aacute;c chức năng cơ sở dữ liệu cụ thể. N&oacute; đ&atilde; x&aacute;c nhận, kịch bản, t&igrave;m kiếm, cứu (ch&egrave;n / cập nhật) v&agrave; x&oacute;a c&aacute;c phương ph&aacute;p, m&agrave; c&ograve;n l&agrave; sự kiện ghi đ&egrave; l&ecirc;n trước v&agrave; sau khi ...(). ...() M&ocirc; h&igrave;nh n&agrave;y cũng cho ph&eacute;p t&igrave;m kiếm dữ liệu bằng c&aacute;ch sử dụng điều kiện. Để hiểu việc sử dụng ch&iacute;nh của m&ocirc; h&igrave;nh n&agrave;y, t&ocirc;i muốn tham khảo c&aacute;c hướng dẫn về c&aacute;c m&ocirc; h&igrave;nh v&agrave; ghi lại hoạt động tr&ecirc;n trang web của khung Yii.</p>\r\n<p>\r\n	EArrayModel (như mỗi Model Yii kh&aacute;c) cũng l&agrave;m việc với c&aacute;c thuộc t&iacute;nh. Những thuộc t&iacute;nh n&agrave;y l&agrave; li&ecirc;n kết với một phần tử mảng duy nhất. Bạn (thực sự phải) c&oacute; thể định nghĩa phần tử của mảng được li&ecirc;n kết với thuộc t&iacute;nh đ&oacute;. Bạn l&agrave;m điều n&agrave;y bằng c&aacute;ch x&aacute;c định cấu tr&uacute;c dữ liệu th&ocirc;ng qua trọng c&aacute;c arrayStructure phương ph&aacute;p () (Xem đoạn Tạo c&aacute;c lớp m&ocirc; h&igrave;nh). B&ecirc;n cạnh những thuộc t&iacute;nh n&agrave;y th&ocirc;ng thường được x&aacute;c định trong cấu tr&uacute;c mảng, ch&uacute;ng t&ocirc;i cũng c&oacute; c&aacute;c thuộc t&iacute;nh id ma thuật. Id thuộc t&iacute;nh n&agrave;y lu&ocirc;n lu&ocirc;n hiện diện v&agrave; đề cập đến kho&aacute; duy nhất của một h&agrave;ng dữ liệu mảng. Id n&agrave;y cũng c&oacute; thể được thay đổi như tất cả c&aacute;c thuộc t&iacute;nh kh&aacute;c. Nếu id thay đổi đ&atilde; tồn tại trong c&aacute;c tập tin dữ liệu, sau đ&oacute; h&agrave;ng dữ liệu với id tương ứng l&agrave; nhận được ghi đ&egrave;.</p>\r\n<h3 id="hh2">\r\n	Ch&egrave;n một h&agrave;ng dữ liệu mới</h3>\r\n<div>\r\n	<div>\r\n		<pre>\r\n<code>$model = new City;\r\n$model-&gt;name = &#39;Amsterdam&#39;;\r\n$model-&gt;position_x = 205;\r\n$model-&gt;position_y = 673;\r\n$model-&gt;save();</code></pre>\r\n	</div>\r\n</div>\r\n<h3 id="hh3">\r\n	Cập nhật một h&agrave;ng dữ liệu hiện c&oacute;</h3>\r\n<div>\r\n	<div>\r\n		<pre>\r\n<code>$model = City::model()-&gt;findById(1);\r\n$model-&gt;position_x = 100;\r\n$model-&gt;position_y = 201;\r\n$model-&gt;save();</code></pre>\r\n	</div>\r\n</div>\r\n<h3 id="hh4">\r\n	X&oacute;a một h&agrave;ng dữ liệu hiện c&oacute;</h3>\r\n<div>\r\n	<div>\r\n		<pre>\r\n$model = City::model()-&gt;findById(1);\r\n$model-&gt;delete();</pre>\r\n	</div>\r\n</div>\r\n<h3 id="hh5">\r\n	X&oacute;a nhiều h&agrave;ng dữ liệu</h3>\r\n<div>\r\n	<div>\r\n		<pre>\r\nCity::model()-&gt;deleteAll(); // Deletes all rows\r\nCity::model()-&gt;deleteAll(/*condition*/); // Deletes all rows matched by the condition</pre>\r\n	</div>\r\n</div>\r\n<h3 id="hh6">\r\n	T&igrave;m c&aacute;c h&agrave;ng dữ liệu</h3>\r\n<div>\r\n	<div>\r\n		<pre>\r\n<code>$model = City::model()-&gt;findById(4); // Returns a single row with id 4\r\n$model = City::model()-&gt;find(); // Returns the first found row\r\n \r\n$models = City::model()-&gt;findAll(); // Returns all rows, conditions may be used\r\n$models = City::model()-&gt;findAll(array(/*condition*/)); // Returns all rows matched by the condition\r\n$models = City::model()-&gt;findAll(array(/*condition*/), 5, 10); // Returns 5 rows matched by the condition, beginning on row number 10 (does exactly work like LIMIT in MySQL)</code></pre>\r\n	</div>\r\n</div>\r\n<h3 id="hh7">\r\n	Sử dụng điều kiện để t&igrave;m dữ liệu mảng</h3>\r\n<p>\r\n	Một điều kiện cần l&agrave; một mảng v&agrave; phải bao gồm b&aacute;o c&aacute;o c&oacute; điều kiện với &#39;thuộc t&iacute;nh =&gt; gi&aacute; trị&#39; cấu tr&uacute;c. Mỗi tuy&ecirc;n bố c&oacute; điều kiện cần phải được t&aacute;ch ra bởi một AND hoặc OR. T&igrave;nh trạng hoạt động như b&igrave;nh thường IF b&aacute;o c&aacute;o trong PHP v&agrave; c&oacute; thể chứa to&aacute;n tử so s&aacute;nh sau đ&acirc;y:</p>\r\n<pre>\r\n  &gt;,&gt; =, &lt;, &lt;=, = (Hoặc ==), =,! ===,! ==,%,!%\r\n</pre>\r\n<p>\r\n	Ngo&agrave;i PHP c&oacute; hai nh&agrave; khai th&aacute;c nhiều hơn,% v&agrave;%!. C&aacute;c nh&agrave; khai th&aacute;c đứng cho tương ứng &quot;chứa&quot; v&agrave; &quot;kh&ocirc;ng c&oacute;&quot;. N&oacute; sẽ kiểm tra xem c&aacute;c chuỗi cho trước c&oacute; thể được t&igrave;m thấy hoặc kh&ocirc;ng t&igrave;m thấy b&ecirc;n trong gi&aacute; trị của một thuộc t&iacute;nh cụ thể. C&aacute;c nh&agrave; điều h&agrave;nh sẽ t&igrave;m kiếm c&aacute;c trường hợp kh&ocirc;ng nhạy cảm.</p>\r\n<p>\r\n	Khi kh&ocirc;ng c&oacute; nh&agrave; điều h&agrave;nh so s&aacute;nh đ&atilde; được sử dụng, điều kiện sẽ tự động chức năng như kết hợp ch&iacute;nh x&aacute;c (= hay ==).</p>\r\n<p>\r\n	Cũng giống như trong PHP, c&aacute;c điều kiện c&oacute; thể chứa c&aacute;c phụ kiện, phụ phụ kiện, v&agrave; vv. N&oacute; c&oacute; thể được nhận ra bởi chỉ cần th&ecirc;m c&aacute;c mảng mới, c&oacute; b&aacute;o c&aacute;o c&oacute; điều kiện. Bằng c&aacute;ch n&agrave;y, một điều kiện v&ocirc; tận c&oacute; thể được tạo ra. Một số v&iacute; dụ:</p>\r\n<div>\r\n	<div>\r\n		<pre>\r\nContact::model()-&gt;findAll(array(array(&#39;id&#39; =&gt; 1)); // Return data with ID 1 (exact matching)\r\nContact::model()-&gt;findAll(array(array(&#39;id &gt;&#39; =&gt; 5), &#39;AND&#39;, array(&#39;id &gt;&#39; =&gt; 15)); // Matches data with an ID bigger than 5 and smaller than 15\r\nContact::model()-&gt;findAll(array(array(&#39;name %&#39; =&gt; &#39;asd&#39;), &#39;OR&#39;, array(&#39;name %&#39; =&gt; &#39;qwe&#39;))); // Matches data which contains asd or qwe\r\nContact::model()-&gt;findAll(array(array(array(&#39;first_name&#39; =&gt; &#39;John&#39;), &#39;OR&#39;, array(&#39;first_name&#39; =&gt; &#39;Matthew&#39;)), &#39;AND&#39;, array(&#39;last_name&#39; =&gt; &#39;Smith&#39;))); // Matches data where the first name is John or Matthew and the last name is Smith</pre>\r\n	</div>\r\n</div>\r\n<p>\r\n	To make conditions a little bit more readable and shorter, you can leave out some array elements:</p>\r\n<p>\r\n	Normal usage:</p>\r\n<div>\r\n	<div>\r\n		<pre>\r\nContact::model()-&gt;findAll(array(array(&#39;id &gt;&#39; =&gt; 5)));</pre>\r\n	</div>\r\n</div>\r\n<p>\r\n	Shorter usage</p>\r\n<div>\r\n	<div>\r\n		<pre>\r\nContact::model()-&gt;findAll(array(&#39;id &gt;&#39; =&gt; 5));</pre>\r\n	</div>\r\n</div>\r\n<p>\r\n	However, with the shorter usage you can&#39;t use the same attributes inside one condition statement. With the following example, only the last attribute will be checked:</p>\r\n<div>\r\n	<div>\r\n		<pre>\r\nContact::model()-&gt;findAll(array(&#39;id&#39; =&gt; 5, &#39;OR&#39;, &#39;id&#39; =&gt; 7)); // Only row with ID 7 will be returned</pre>\r\n	</div>\r\n</div>\r\n<p>\r\n	The following on the other hand will work as aspected, because of the &gt;= and &lt;= comparison operators.</p>\r\n<div>\r\n	<div>\r\n		<pre>\r\nContact::model()-&gt;findAll(array(&#39;id &gt;=&#39; =&gt; 5, &#39;AND&#39;, &#39;id &lt;=&#39; =&gt; 7)); // All rows with ID 5, 6 and 7 will be returned</pre>\r\n	</div>\r\n</div>\r\n<p>\r\n	This limitation is there because the condition &#39;array&#39; can&#39;t have two or more elements with the same key. The first id will be overwritten by the last defined id. In this case you still need to use the normal usage instead.</p>\r\n<h2 id="hh8">\r\n	Tạo c&aacute;c lớp m&ocirc; h&igrave;nh</h2>\r\n<p>\r\n	Mỗi lớp học phải mở rộng m&ocirc; h&igrave;nh mảng từ EArrayModel v&agrave; cần phải ghi đ&egrave; l&ecirc;n một v&agrave;i phương ph&aacute;p. Cấu tr&uacute;c của lớp n&agrave;y kh&aacute;c với CActiveModel của t&ecirc;n tập tin phương ph&aacute;p () v&agrave; arrayStructure ().</p>\r\n<p>\r\n	V&iacute; dụ về một lớp EArrayModel:</p>\r\n<div>\r\n	<div>\r\n		<pre>\r\n&lt;?php\r\nclass RankArray extends ArrayModel\r\n{\r\n    /**\r\n    * Returns the static model of the specified AM class.\r\n    * @return the static model class\r\n    */\r\n    public static function model($className=__CLASS__)\r\n    {\r\n        return parent::model($className);\r\n    }\r\n \r\n    /**\r\n    * @return string the associated array data file location (must be writable, to make use of the saving functionalities)\r\n    */\r\n    public function fileName()\r\n    {\r\n        return &#39;application.data.ranks&#39;;\r\n    }\r\n \r\n    /**\r\n    * @return array the associated array structure (&#39;key&#39; =&gt; &#39;attribute&#39;). The list of\r\n    * available attributes will be based on this list.\r\n    */\r\n    public function arrayStructure()\r\n    {\r\n        return array(\r\n            &#39;name&#39; =&gt; array(\r\n                &#39;male&#39; =&gt; &#39;name_male&#39;,\r\n                &#39;female&#39; =&gt; &#39;name_female&#39;,\r\n            ),\r\n            &#39;points&#39; =&gt; &#39;points&#39;,\r\n        );\r\n    }\r\n \r\n    /**\r\n    * @return array validation rules for model attributes.\r\n    */\r\n    public function rules()\r\n    {\r\n        return array(\r\n            array(&#39;name_male, name_female&#39;, &#39;length&#39;, &#39;max&#39; =&gt; 20),\r\n        );\r\n    }\r\n \r\n    /**\r\n    * @return array validation rules for model attributes.\r\n    */\r\n    public function attributeLabels()\r\n    {\r\n        return array();\r\n    }\r\n}\r\n?&gt;</pre>\r\n	</div>\r\n</div>\r\n<h2 id="hh9">\r\n	V&iacute; dụ tập tin dữ liệu li&ecirc;n quan</h2>\r\n<p>\r\n	C&aacute;c tập tin dữ liệu được bảo vệ / dữ liệu / ranks.php, li&ecirc;n quan đến m&ocirc; h&igrave;nh RankArray của đoạn trước</p>\r\n<div>\r\n	<div>\r\n		<pre>\r\n&lt;?php\r\n/**\r\n* Data file generated by RankArray (ArrayModel)\r\n* Date: June 30, 2011, 9:57 pm\r\n*\r\n* Allowed data structure:\r\n*   array(\r\n*       &#39;name&#39; =&gt; array(\r\n*           &#39;male&#39; =&gt; &#39;name_male&#39;,\r\n*           &#39;female&#39; =&gt; &#39;name_female&#39;,\r\n*       ),\r\n*       &#39;points&#39; =&gt; &#39;points&#39;,\r\n*   )\r\n*/\r\nreturn array(\r\n    1 =&gt; array(\r\n        &#39;name&#39; =&gt; array(\r\n            &#39;male&#39; =&gt; &#39;Cleaner&#39;,\r\n            &#39;female&#39; =&gt; &#39;Cleaner&#39;,\r\n        ),\r\n        &#39;points&#39; =&gt; 5,\r\n    ),\r\n    2 =&gt; array(\r\n        &#39;name&#39; =&gt; array(\r\n            &#39;male&#39; =&gt; &#39;Bagman&#39;,\r\n            &#39;female&#39; =&gt; &#39;Bagman&#39;,\r\n        ),\r\n        &#39;points&#39; =&gt; 50,\r\n    ),\r\n);</pre>\r\n	</div>\r\n</div>\r\n<h2 id="hh10">\r\n	Kh&aacute;c</h2>\r\n<div>\r\n	<div>\r\n		<pre>\r\n$model-&gt;isNew; // Checks whether the current data model is new, works exactly like isNewRecord\r\nModelName::model()-&gt;getData(); // Returns the raw data for manual data manipulation\r\nModelName::model()-&gt;setData($data); // Set raw data manually after manipulation\r\nModelName::model()-&gt;flushData(); // Cleans the cached data and forces to renew the data on next data file access</pre>\r\n	</div>\r\n</div>\r\n<h2 id="hh11">\r\n	Ghi ch&uacute; Kỹ thuật</h2>\r\n<ul>\r\n	<li>\r\n		Dữ liệu được lưu trữ b&ecirc;n trong nhận được một biến tĩnh. Bằng c&aacute;ch n&agrave;y, c&aacute;c m&ocirc; h&igrave;nh sẽ kh&ocirc;ng truy cập hệ thống tập tin mỗi khi n&oacute; cần một số dữ liệu. C&aacute;c dữ liệu lưu trữ tất nhi&ecirc;n sẽ tự động được cập nhật sau khi tiết kiệm.</li>\r\n	<li>\r\n		Khi ch&egrave;n, cập nhật hoặc x&oacute;a c&aacute;c h&agrave;ng dữ liệu, tập tin dữ liệu l&agrave; nhận được lưu lại mỗi lần. H&atilde;y cẩn thận khi bạn cần phải tiết kiệm rất nhiều m&ocirc; h&igrave;nh kh&aacute;c nhau c&ugrave;ng một l&uacute;c.</li>\r\n	<li>\r\n		Sử dụng m&ocirc; h&igrave;nh n&agrave;y chỉ d&agrave;nh cho dữ liệu tĩnh c&oacute; thực sự cần phải được thay đổi kh&ocirc;ng thường xuy&ecirc;n. Đối với dữ liệu động n&oacute; sẽ được th&ecirc;m rất nhiều hiệu quả sử dụng cơ sở dữ liệu ghi lại hoạt động thay thế. Ngo&agrave;i ra, thay đổi dữ liệu tr&ecirc;n hệ thống tập tin sẽ kh&oacute;a c&aacute;c tập tin trong một khoảng thời gian rất ngắn. Điều đ&oacute; c&oacute; thể cung cấp cho c&aacute;c lỗi php tốt đẹp khi hai m&ocirc; h&igrave;nh tiết kiệm c&ugrave;ng một l&uacute;c.</li>\r\n</ul>\r\n<h2 id="hh12">\r\n	C&agrave;i đặt</h2>\r\n<ol>\r\n	<li>\r\n		Tr&iacute;ch xuất arraymodel từ kho lưu trữ để bảo vệ / mở rộng</li>\r\n	<li>\r\n		Tạo một m&ocirc; h&igrave;nh cho mỗi tập tin dữ liệu mảng v&agrave; cấu h&igrave;nh n&oacute;</li>\r\n	<li>\r\n		Tạo tập tin dữ liệu tương ứng v&agrave; cuối c&ugrave;ng l&agrave;m cho n&oacute; c&oacute; thể ghi. Bạn c&oacute; thể điền v&agrave;o c&aacute;c tập tin với nội dung &lt;php trở lại mảng ();?&gt; (Trong phi&ecirc;n bản mới nhất, đ&oacute; l&agrave; kh&ocirc;ng cần thiết nữa)</li>\r\n	<li>\r\n		Bạn đang tắt để đi</li>\r\n</ol>\r\n<h2 id="hh13">\r\n	Y&ecirc;u cầu</h2>\r\n<ul>\r\n	<li>\r\n		Yii 1.1 hoặc ở tr&ecirc;n (thử nghiệm tr&ecirc;n 1.1.7)</li>\r\n	<li>\r\n		Th&ocirc;ng thường</li>\r\n</ul>\r\n<h2 id="hh14">\r\n	Todo</h2>\r\n<ul>\r\n	<li>\r\n		Xử l&yacute; lỗi tốt hơn với những văn bản lỗi tốt đẹp</li>\r\n	<li>\r\n		Cung cấp một nh&agrave; cung cấp dữ liệu tương ứng, như CActiveDataProvider. Như một giải ph&aacute;p tạm thời, CArrayDataProvider kết hợp với $ yourArrayModel-&gt; getdata () c&oacute; thể được sử dụng.</li>\r\n</ul>\r\n<h2 id="hh15">\r\n	T&agrave;i</h2>\r\n<ul>\r\n	<li>\r\n		http://www.yiiframework.com/doc/guide/1.1/en/basics.model</li>\r\n	<li>\r\n		http://www.yiiframework.com/doc/guide/1.1/en/form.model</li>\r\n	<li>\r\n		http://www.yiiframework.com/doc/guide/1.1/en/database.ar</li>\r\n</ul>\r\n<p>\r\n	Ngo&agrave;i ra, t&ocirc;i muốn cảm ơn c&aacute;c nh&agrave; ph&aacute;t triển đằng sau Yii cho việc tạo khu&ocirc;n khổ lớn như vậy! ;-)</p>\r\n', 1309888127, 1310101252, 1, NULL, 'model, active record, activerecord, array, data, file, find, validate, save'),
(3, 'Xây dựng hàm cấu hình cho WebBaseController', '', '\r\n	D&ugrave;ng CFormModel\r\n\r\n	Th&ocirc;ng qua lớp CFormModel, ta c&oacute; thể tạo m&ocirc; h&igrave;nh Form để kiểm tra dữ liệu, nếu thấy dữ liệu ph&ugrave; hợp th&igrave; thực hiện việc lưu gi&aacute; trị v&agrave;o bảng Setting.\r\n\r\n	D&ugrave;ng CActive', '<h2>\r\n	D&ugrave;ng CFormModel</h2>\r\n<p>\r\n	Th&ocirc;ng qua lớp CFormModel, ta c&oacute; thể tạo m&ocirc; h&igrave;nh Form để kiểm tra dữ liệu, nếu thấy dữ liệu ph&ugrave; hợp th&igrave; thực hiện việc lưu gi&aacute; trị v&agrave;o bảng Setting.</p>\r\n<h2>\r\n	D&ugrave;ng CActiveRecord với scenario <em>Configure</em></h2>\r\n<p>\r\n	Dựa v&agrave;o t&iacute;nh năng scenario của Model, ta c&oacute; thể sử dụng lại CActiveRecord để lưu trữ c&aacute;c gi&aacute; trị tương ứng với Config cho ch&iacute;nh CActiveRecord đ&oacute;. Nhờ vậy, tiết kiệm được 1 model.</p>\r\n', 1309911724, 1309911742, 1, 11, 'configure, config, model'),
(4, 'Kohana Image Library', '', '\r\n	\r\n		Provides methods for the dynamic manipulation of images. Various image formats such as JPEG, PNG, and GIF can be resized, cropped, rotated and sharpened.\r\n	\r\n		All image manipulations are applied to a temporary image. Only the save() method is perm', '<div class="level1">\r\n	<p>\r\n		Provides methods for the dynamic manipulation of images. Various image formats such as <acronym title="Joint Photographics Experts Group">JPEG</acronym>, <acronym title="Portable Network Graphics">PNG</acronym>, and <acronym title="Graphics Interchange Format">GIF</acronym> can be resized, cropped, rotated and sharpened.</p>\r\n	<p>\r\n		All image manipulations are applied to a <strong>temporary</strong> image. Only the <code>save()</code> method is permanent, the temporary image being written to a specified image file.</p>\r\n	<div class="box blue">\r\n		<div class="xbox">\r\n			<div class="box_content">\r\n				<p>\r\n					Image manipulation methods can be chained efficiently. Recommended order: <code>resize</code>, <code>crop</code>, <code>sharpen</code>, <code>quality</code> and <code>rotate</code> or <code>flip</code></p>\r\n				<p>\r\n					<code>Choose Driver</code></p>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class="level2">\r\n	<p>\r\n		Uses a driver, configured in <code>config/image.php</code>. The default driver uses the GD2 library, bundled with <acronym title="Hypertext Preprocessor">PHP</acronym>. ImageMagick may be used if available.</p>\r\n	<p>\r\n		When loading the library, a path to the image file, (relative or absolute) must be passed as a parameter.</p>\r\n	<p>\r\n		Load the Image Library in your controller using the <strong>new</strong> keyword:</p>\r\n	<pre class="code php">\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span> <span class="sy0">=</span> <span class="kw2">new</span> Image<span class="br0">(</span><span class="st0">&#39;./photo.jpg&#39;</span><span class="br0">)</span><span class="sy0">;</span></pre>\r\n	<p>\r\n		Access to the library is available through <code>$this&rarr;image</code> Some methods are chainable.</p>\r\n</div>\r\n<h2>\r\n	Default Setting</h2>\r\n<div class="level2">\r\n	<p>\r\n		To change default settings, edit <code>application/config/image.php</code></p>\r\n	<p>\r\n		Drivers available:</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				<strong>GD</strong> - The default driver, requires GD2 version &gt;= 2.0.34 (Debian / Ubuntu users note: Some functions, eg. <code>sharpen</code> may not be available)</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				<strong>ImageMagick</strong> - Windows users <strong>must</strong> specify a path to the binary. Unix versions will attempt to auto-locate.</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				<strong>GraphicsMagick</strong> - Windows users <strong>must</strong> specify a path to the binary. Unix versions will attempt to auto-locate.</div>\r\n		</li>\r\n	</ul>\r\n	<pre class="code php">\r\n<span class="re1">$config</span><span class="br0">[</span><span class="st0">&#39;driver&#39;</span><span class="br0">]</span> <span class="sy0">=</span> <span class="st0">&#39;GD&#39;</span><span class="sy0">;</span>\r\n<span class="co1">// For Windows</span>\r\n<span class="re1">$config</span><span class="br0">[</span><span class="st0">&#39;params&#39;</span><span class="br0">]</span> <span class="sy0">=</span> <a href="http://www.php.net/array"><span class="kw3">array</span></a><span class="br0">(</span><span class="st0">&#39;directory&#39;</span> <span class="sy0">=&gt;</span> <span class="st0">&#39;C:/ImageMagick&#39;</span><span class="br0">)</span><span class="sy0">;</span>\r\n<span class="co1">// For Un*x assuming the binary is in usr/local/bin</span>\r\n<span class="re1">$config</span><span class="br0">[</span><span class="st0">&#39;params&#39;</span><span class="br0">]</span> <span class="sy0">=</span> <a href="http://www.php.net/array"><span class="kw3">array</span></a><span class="br0">(</span><span class="st0">&#39;directory&#39;</span> <span class="sy0">=&gt;</span> <span class="st0">&#39;/usr/local/bin&#39;</span><span class="br0">)</span><span class="sy0">;</span>\r\n</pre>\r\n	<h3 class="code php">\r\n		<br />\r\n		<span class="sy0">Resize</span></h3>\r\n</div>\r\n<p>\r\n	<code>resize()</code> is used to resize an image. This method is chainable. By default, the aspect ratio will be maintained automatically.</p>\r\n<div class="level3">\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Width in pixels of the resized image.</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Height in pixels of the resized image.</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Master dimension, default is Auto. Options : Image::NONE, Image::AUTO, Image::HEIGHT, Image::WIDTH</div>\r\n		</li>\r\n	</ul>\r\n	<p>\r\n		<strong>Example:</strong></p>\r\n	<pre class="code php">\r\n<span class="co1">// Resize original image to width of 400 and height of 200 pixels without maintaining the aspect ratio.</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">resize</span><span class="br0">(</span><span class="nu0">400</span><span class="sy0">,</span> <span class="nu0">200</span><span class="sy0">,</span> Image<span class="sy0">::</span><span class="me2">NONE</span><span class="br0">)</span>\r\n<span class="co1">//Note: The output image is resized to width of 400 and height of 200, without maintaining the aspect ratio</span>\r\n&nbsp;\r\n<span class="co1">// Resize original image to Height of 200 pixels, using height to maintain aspect ratio.</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">resize</span><span class="br0">(</span><span class="nu0">400</span><span class="sy0">,</span> <span class="nu0">200</span><span class="sy0">,</span> Image<span class="sy0">::</span><span class="me2">HEIGHT</span><span class="br0">)</span>\r\n<span class="co1">// Note: Passing width = 400 has no effect on the resized width, which is controlled by the 3rd argument, maintain aspect ratio on height</span>\r\n&nbsp;\r\n<span class="co1">// Resize original image (800x600) using automatic aspect ratio calculation</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">resize</span><span class="br0">(</span><span class="nu0">740</span><span class="sy0">,</span><span class="nu0">400</span><span class="sy0">,</span>Image<span class="sy0">::</span><span class="me2">AUTO</span><span class="br0">)</span>\r\n<span class="co1">// the resulting resized image is 533x400 because Kohana determines the master dimension to be height 800/740 &lt; 600/400</span></pre>\r\n</div>\r\n<h3>\r\n	Crop</h3>\r\n<div class="level3">\r\n	<p>\r\n		<code>crop()</code> is used to crop an image to a specific width and height. This method is chainable.</p>\r\n	<p>\r\n		The <strong>top</strong> and <strong>left</strong> offsets may be specified. By default &#39;top&#39; and &#39;left&#39; use the &#39;center&#39; offset.</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Width in pixels of the cropped image.</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Height in pixels of the cropped image.</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Top offset of input image, pixel value or one of &#39;top&#39;, &#39;center&#39;, &#39;bottom&#39;.</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Left offset of input image, pixel value or one of &#39;left&#39;, &#39;center&#39;, &#39;right&#39;.</div>\r\n		</li>\r\n	</ul>\r\n	<p>\r\n		<strong>Example:</strong></p>\r\n	<pre class="code php">\r\n<span class="co1">// Crop from the original image, starting from the &#39;center&#39; of the image from the &#39;top&#39; and the &#39;center&#39; of the image from the &#39;left&#39;</span>\r\n<span class="co1">// to a width of 400 and height of 350.</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">crop</span><span class="br0">(</span><span class="nu0">400</span><span class="sy0">,</span> <span class="nu0">350</span><span class="br0">)</span></pre>\r\n</div>\r\n<h3>\r\n	Rotate</h3>\r\n<div class="level3">\r\n	<p>\r\n		<code>rotate()</code> is used to rotate an image by a specified number of degrees. This method is chainable. The image may be rotated clockwise or anti-clockwise, by a maximum of 180 degrees.</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Degrees to rotate. (negative rotates anti-clockwise) There is no default.</div>\r\n		</li>\r\n	</ul>\r\n	<p>\r\n		<strong>Example:</strong></p>\r\n	<pre class="code php">\r\n<span class="co1">// Rotate the image by 45 degrees to the &#39;left&#39; or anti-clockwise.</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">rotate</span><span class="br0">(</span><span class="nu0">-45</span><span class="br0">)</span></pre>\r\n</div>\r\n<h3>\r\n	Flip</h3>\r\n<div class="level3">\r\n	<p>\r\n		<code>flip()</code> is used to rotate an image along the horizontal or vertical axis. The method is chainable.</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Direction. Horizontal = 5, Vertical = 6</div>\r\n		</li>\r\n	</ul>\r\n	<p>\r\n		<strong>Example:</strong></p>\r\n	<pre class="code php">\r\n<span class="co1">// Rotate the image along the vertical access.</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">flip</span><span class="br0">(</span><span class="nu0">6</span><span class="br0">)</span><span class="sy0">;</span></pre>\r\n</div>\r\n<h3>\r\n	Sharpen</h3>\r\n<div class="level3">\r\n	<p>\r\n		<code>sharpen()</code> Is used to sharpen an image by a specified amount. This method is chainable.</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Sharpen amount to apply to image. Range is between 1 and 100. Optimal amount is about 20. There is no default.</div>\r\n		</li>\r\n	</ul>\r\n	<p>\r\n		<strong>Example:</strong></p>\r\n	<pre class="code php">\r\n<span class="co1">// Sharpen the image by an amount of 15.</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">sharpen</span><span class="br0">(</span><span class="nu0">15</span><span class="br0">)</span><span class="sy0">;</span></pre>\r\n</div>\r\n<h3>\r\n	Quality</h3>\r\n<div class="level3">\r\n	<p>\r\n		<code>quality()</code> Is used to adjust the image quality by a specified percentage. This method is chainable.</p>\r\n	<p>\r\n		Note: The method is for reducing the quality of an image, in order to reduce the file size of the image, saving bandwidth and load time. It cannot be used to actually improve the quality of an input image.</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				[integer] Percentage amount to adjust quality. Range is between 1 and 100. Optimal percentage is from 75 to 85. There is no default.</div>\r\n		</li>\r\n	</ul>\r\n	<p>\r\n		<strong>Example:</strong></p>\r\n	<pre class="code php">\r\n<span class="co1">// Reduce image quality to 75 percent of original</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">quality</span><span class="br0">(</span><span class="nu0">75</span><span class="br0">)</span><span class="sy0">;</span></pre>\r\n</div>\r\n<h3>\r\n	<a id="save" name="save">save()</a></h3>\r\n<div class="level3">\r\n	<p>\r\n		<code>save($new_image = FALSE, $chmod = 0644, $keep_actions = FALSE)</code> Is used to save the image to a file on disk. This method is NOT chainable. The default is to overwrite the input image file. Accepts a relative or absolute file path.</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				<strong>[string]</strong> <em>$new_image</em> The file path and output image file name. Default is to overwrite input file.</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				<strong>[integer]</strong> <em>$chmod</em> permissions for new image (default 0644)</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				<strong>[bool]</strong> <em>$keep_actions</em> keep or discard image process actions (default FALSE).</div>\r\n		</li>\r\n	</ul>\r\n	<p>\r\n		<strong>Example:</strong></p>\r\n	<pre class="code php">\r\n<span class="co1">// Save image and overwrite the input image file</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">save</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span>\r\n<span class="co1">//</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">save</span><span class="br0">(</span><span class="st0">&#39;./new-image.jpg&#39;</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// Save image to a new file.</span></pre>\r\n</div>\r\n<h3>\r\n	Render</h3>\r\n<div class="level3">\r\n	<p>\r\n		<code>render($keep_actions = FALSE) </code> is used to output the image to the browser. This method is NOT chainable. It means that the headers corresponding to the image format are sent and the raw image stream with manipulation applied will be outputted directly to the browser. Returns TRUE on success or FALSE on failure.</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				<strong>[bool]</strong> <em>$keep_actions</em> keep or discard image process actions (default FALSE)</div>\r\n		</li>\r\n	</ul>\r\n	<p>\r\n		<strong>Example:</strong></p>\r\n	<pre class="code php">\r\n<span class="re1">$image</span> <span class="sy0">=</span> <span class="kw2">new</span> Image<span class="br0">(</span><span class="re1">$dir</span><span class="sy0">.</span><span class="st0">&#39;moo.jpg&#39;</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// Instantiate the library</span>\r\n<span class="re1">$image</span><span class="sy0">-&gt;</span><span class="me1">resize</span><span class="br0">(</span><span class="nu0">400</span><span class="sy0">,</span> <span class="kw2">NULL</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">crop</span><span class="br0">(</span><span class="nu0">400</span><span class="sy0">,</span> <span class="nu0">350</span><span class="sy0">,</span> <span class="st0">&#39;top&#39;</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">sharpen</span><span class="br0">(</span><span class="nu0">20</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">quality</span><span class="br0">(</span><span class="nu0">75</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// apply image manipulations</span>\r\n&nbsp;\r\n<span class="co1">// Output the image directly to the browser</span>\r\n<span class="re1">$this</span><span class="sy0">-&gt;</span><span class="me1">image</span><span class="sy0">-&gt;</span><span class="me1">render</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span></pre>\r\n</div>\r\n<h3>\r\n	__GET</h3>\r\n<div class="level3">\r\n	<p>\r\n		<code>__get()</code> is used to handle retrieval of pre-save image properties. Properties available are:</p>\r\n	<ul>\r\n		<li class="level1">\r\n			<div class="li">\r\n				&#39;file&#39;</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				&#39;width&#39;</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				&#39;height&#39;</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				&#39;type&#39;</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				&#39;ext&#39;</div>\r\n		</li>\r\n		<li class="level1">\r\n			<div class="li">\r\n				&#39;mime&#39;</div>\r\n		</li>\r\n	</ul>\r\n</div>\r\n<h2>\r\n	Full Example</h2>\r\n<div class="level2">\r\n	<p>\r\n		Place this code into a controller:</p>\r\n	<pre class="code php">\r\n<span class="co1">// The original image is located in folder /application/upload.</span>\r\n<span class="re1">$dir</span> <span class="sy0">=</span> <a href="http://www.php.net/str_replace"><span class="kw3">str_replace</span></a><span class="br0">(</span><span class="st0">&#39;<span class="es0">\\\\</span>&#39;</span><span class="sy0">,</span> <span class="st0">&#39;/&#39;</span><span class="sy0">,</span> <a href="http://www.php.net/realpath"><span class="kw3">realpath</span></a><span class="br0">(</span><a href="http://www.php.net/dirname"><span class="kw3">dirname</span></a><span class="br0">(</span><span class="kw2">__FILE__</span><span class="br0">)</span><span class="sy0">.</span><span class="st0">&#39;/../upload&#39;</span><span class="br0">)</span><span class="br0">)</span><span class="sy0">.</span><span class="st0">&#39;/&#39;</span><span class="sy0">;</span>\r\n<span class="re1">$image</span> <span class="sy0">=</span> <span class="kw2">new</span> Image<span class="br0">(</span><span class="re1">$dir</span><span class="sy0">.</span><span class="st0">&#39;moo.jpg&#39;</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// Instantiate the library</span>\r\n<span class="re1">$image</span><span class="sy0">-&gt;</span><span class="me1">resize</span><span class="br0">(</span><span class="nu0">400</span><span class="sy0">,</span> <span class="kw2">NULL</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">crop</span><span class="br0">(</span><span class="nu0">400</span><span class="sy0">,</span> <span class="nu0">350</span><span class="sy0">,</span> <span class="st0">&#39;top&#39;</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">sharpen</span><span class="br0">(</span><span class="nu0">20</span><span class="br0">)</span><span class="sy0">-&gt;</span><span class="me1">quality</span><span class="br0">(</span><span class="nu0">75</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// apply image manipulations</span>\r\n<span class="re1">$image</span><span class="sy0">-&gt;</span><span class="me1">save</span><span class="br0">(</span><span class="re1">$dir</span><span class="sy0">.</span><span class="st0">&#39;super-cow-crop.jpg&#39;</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// Write the changed image to a new file in the original input folder. Manipulations are discarded after the save call ($keep_action default TRUE).</span>\r\n<a href="http://www.php.net/echo"><span class="kw3">echo</span></a> Kohana<span class="sy0">::</span><span class="me2">debug</span><span class="br0">(</span><span class="re1">$image</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// Display some useful info about the operation **for debugging only**.</span>\r\n<span class="re1">$image</span><span class="sy0">-&gt;</span><span class="me1">resize</span><span class="br0">(</span><span class="nu0">300</span><span class="sy0">,</span> <span class="kw2">NULL</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// Resize the original image</span>\r\n$<span class="re1">image</span><span class="sy0">-&gt;</span><span class="me1">save</span><span class="br0">(</span><span class="re1">$dir</span><span class="sy0">.</span><span class="st0">&#39;super-cow-resize.jpg&#39;</span><span class="sy0">,</span> <span class="kw2">TRUE</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// Write the changed image to a new file in the original input folde\r\n</span><span class="re1">$image</span><span class="sy0">-&gt;</span><span class="me1">crop</span><span class="br0">(</span><span class="nu0">300</span><span class="sy0">,</span> <span class="nu0">250</span><span class="sy0">,</span> <span class="st0">&#39;top&#39;</span><span class="br0">)</span><span class="sy0">;</span> <span class="co1">// Resize and crop the original image ($keep_action set to TRUE means that resize manipulation has been kept after the save method call).</span></pre>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 1310035300, 1310035300, 1, NULL, '');
INSERT INTO `article` (`id`, `title`, `alias`, `description`, `body`, `createtime`, `updatetime`, `uid`, `cid`, `tags`) VALUES
(5, 'Using Uniform', '', '\r\n	&nbsp;\r\n\r\n	Đ&atilde; bao giờ bạn muốn bạn c&oacute; thể hộp kiểm tra phong c&aacute;ch, thả xuống menu, c&aacute;c n&uacute;t radio, v&agrave; c&aacute;c tập tin tải l&ecirc;n đầu v&agrave;o?&nbsp;Bao giờ muốn bạn c&oacute; thể điều khiển c&aacute;i nh', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<font><font>Đ&atilde; bao giờ bạn muốn bạn c&oacute; thể hộp kiểm tra phong c&aacute;ch, thả xuống menu, c&aacute;c n&uacute;t radio, v&agrave; c&aacute;c tập tin tải l&ecirc;n đầu v&agrave;o?&nbsp;</font><font>Bao giờ muốn bạn c&oacute; thể điều khiển c&aacute;i nh&igrave;n v&agrave; cảm nhận của c&aacute;c yếu tố h&igrave;nh thức của bạn giữa tất cả c&aacute;c tr&igrave;nh duyệt?</font></font></p>\r\n<p>\r\n	<font><font>Nếu vậy, thống nhất l&agrave; người bạn tốt nhất của bạn.</font></font></p>\r\n<p>\r\n	<font><font>Mặt nạ h&igrave;nh thức kiểm so&aacute;t ti&ecirc;u chuẩn của bạn thống nhất với c&aacute;c điều khiển t&ugrave;y chỉnh theo chủ đề.&nbsp;</font><font>N&oacute; hoạt động đồng bộ với c&aacute;c yếu tố h&igrave;nh thức thực sự của bạn để đảm bảo khả năng tiếp cận v&agrave; khả năng tương th&iacute;ch.</font></font></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div id="docs">\r\n	<h4>\r\n		<font><font>C&agrave;i đặt</font></font></h4>\r\n	<p>\r\n		<font><font>Lắp đặt đồng phục kh&aacute; đơn giản.&nbsp;</font><font>Trước ti&ecirc;n, h&atilde;y chắc chắn rằng bạn c&oacute; jQuery 1.3 + c&agrave;i đặt.&nbsp;</font><font>Sau đ&oacute;, bạn sẽ muốn li&ecirc;n kết đến tập tin jquery.uniform.js v&agrave; uniform.default.css trong khu vực đứng đầu của trang của bạn:</font></font></p>\r\n	<p>\r\n		C&aacute;ch sử dụng cơ bản&nbsp;</p>\r\n	<p>\r\n		<font><font>Sử dụng thống nhất c&oacute; thể được kh&aacute; dễ d&agrave;ng.&nbsp;</font><font>Chỉ cần gọi:</font></font></p>\r\n	<code><font><font>$ (Function () {$ (&quot;chọn&quot;) thống nhất ();});</font></font></code>\r\n	<p>\r\n		<font><font>Để &quot;thống nhất&quot; tất cả c&aacute;c yếu tố h&igrave;nh thức c&oacute; thể, chỉ cần l&agrave;m một c&aacute;i g&igrave; đ&oacute; như thế n&agrave;y:</font></font></p>\r\n	<code><font><font>$ (Chọn, nhập v&agrave;o hộp kiểm, nhập v&agrave;o đ&agrave;i ph&aacute;t thanh, đầu v&agrave;o: tập tin &quot;) thống nhất ();</font></font></code>\r\n	<h4>\r\n		<font><font>Th&ecirc;m c&aacute;c th&ocirc;ng số</font></font></h4>\r\n	<p>\r\n		<font><font>Bạn c&oacute; thể vượt qua trong c&aacute;c tham số phụ để kiểm so&aacute;t c&aacute;c kh&iacute;a cạnh nhất định của Thống nhất.&nbsp;</font><font>Để vượt qua trong c&aacute;c th&ocirc;ng số, sử dụng c&uacute; ph&aacute;p như thế n&agrave;y:</font></font></p>\r\n	<pre>\r\n<code><font><font>$ (&quot;Chọn&quot;) thống nhất ({param1: gi&aacute; trị, param2: gi&aacute; trị, param3: gi&aacute; trị}).</font></font></code></pre>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#selectClass"><font><font>selectClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#radioClass"><font><font>radioClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#checkboxClass"><font><font>checkboxClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#fileClass"><font><font>fileClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#filenameClass"><font><font>filenameClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#fileBtnClass"><font><font>fileBtnClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#fileDefaultText"><font><font>fileDefaultText (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#fileBtnText"><font><font>fileBtnText (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#checkedClass"><font><font>checkedClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#focusClass"><font><font>focusClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#disabledClass"><font><font>disabledClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#activeClass"><font><font>activeClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#hoverClass"><font><font>hoverClass (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#useID"><font><font>useID (boolean)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#idPrefix"><font><font>idPrefix (string)</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#resetSelector"><font><font>resetSelector (boolean / string)</font></font></a></h5>\r\n	<br />\r\n	<h4>\r\n		<font><font>C&aacute;c chức năng</font></font></h4>\r\n	<p>\r\n		<font><font>Ngo&agrave;i ra c&aacute;c th&ocirc;ng số, c&oacute; một v&agrave;i c&aacute;ch kh&aacute;c bạn c&oacute; thể tương t&aacute;c với đồng phục.</font></font></p>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#uniform-update"><font><font>. $ Uniform.update ([Elem / chuỗi chọn]);</font></font></a></h5>\r\n	<h5>\r\n		<a href="http://uniformjs.com/#uniform-elements"><font><font>. Uniform.elements []</font></font></a></h5>\r\n	<br />\r\n	<h4>\r\n		<font><font>Mẹo v&agrave; thủ thuật</font></font></h4>\r\n	<p>\r\n		<font><font>Thống nhất được cho l&agrave; kh&aacute; đơn giản, nhưng c&oacute; một v&agrave;i điều m&agrave; c&oacute; thể được kh&ocirc;n lanh.&nbsp;</font><font>Dưới đ&acirc;y l&agrave; một số lời khuy&ecirc;n rằng c&oacute; thể l&agrave;m cho kinh nghiệm của bạn đơn giản:</font></font></p>\r\n	<p>\r\n		<font><font>H&atilde;y nhớ để thay đổi c&aacute;c lớp CSS trong chủ đề nếu bạn thay đổi c&aacute;c th&ocirc;ng số cho c&aacute;c lớp học của c&aacute;c yếu tố &#39;.</font><font>Điều n&agrave;y c&oacute; thể l&agrave; c&ocirc;ng việc tẻ nhạt, nhưng nếu bạn kh&ocirc;ng l&agrave;m điều đ&oacute;, n&oacute; sẽ kh&ocirc;ng nh&igrave;n ch&iacute;nh x&aacute;c.&nbsp;</font><font>T&igrave;m kiếm v&agrave; Thay thế l&agrave; bạn của bạn.</font></font></p>\r\n	<p>\r\n		<font><font>Thống nhất c&oacute; thể kh&ocirc;ng tự động ph&aacute;t hiện thay đổi gi&aacute; trị năng động.&nbsp;</font><font>Nếu bạn thay đổi c&aacute;c yếu tố trong Javascript hoặc sử dụng một n&uacute;t Reset của một số loại ghi nhớ để gọi $ uniform.update (); để đồng bộ c&aacute;c thay đổi với đồng phục.</font></font></p>\r\n	<p>\r\n		<font><font>Thống nhất l&agrave; v&ocirc; hiệu h&oacute;a trong IE6.&nbsp;</font><font>N&oacute; kh&ocirc;ng thể để sửa chữa do c&aacute;ch IE6 xử l&yacute; c&aacute;c yếu tố h&igrave;nh thức.&nbsp;</font><font>Nếu bạn quan t&acirc;m về những người sử dụng IE6, cung cấp cho n&oacute; một c&aacute;i nh&igrave;n nhanh ch&oacute;ng để đảm bảo &quot;trần truồng&quot; của bạn yếu tố h&igrave;nh thức nh&igrave;n ổn trong đ&oacute;.</font></font></p>\r\n	<p>\r\n		<font><font>Bạn đang ở tr&ecirc;n của ri&ecirc;ng bạn cho phong c&aacute;ch đầu v&agrave;o văn bản v&agrave; nhiều hơn nữa.&nbsp;</font><font>May mắn thay, những điều m&agrave; kh&ocirc;ng được xử l&yacute; bằng c&aacute;ch thống nhất kh&aacute; dễ d&agrave;ng để da.&nbsp;</font><font>:)</font></font></p>\r\n	<p>\r\n		<font><font>Nếu bạn c&oacute; &yacute; tưởng, hoặc lỗi, xin vui l&ograve;ng gửi ch&uacute;ng trong&nbsp;</font></font><a href="http://github.com/pixelmatrix/uniform"><font><font>GitHub</font></font></a><font><font>&nbsp;.&nbsp;</font><font>Ch&uacute;ng t&ocirc;i dựa v&agrave;o người d&ugrave;ng của ch&uacute;ng t&ocirc;i cho những &yacute; tưởng cải tiến v&agrave; b&aacute;o c&aacute;o lỗi.&nbsp;</font><font>Nếu kh&ocirc;ng thống nhất sẽ ở lại tĩnh.</font></font></p>\r\n</div>\r\n<div id="themes">\r\n	<h3>\r\n		<font><font>Chủ đề</font></font></h3>\r\n	<p>\r\n		<font><font>Theming l&agrave; trung t&acirc;m triết l&yacute; của Uniform .&nbsp;</font><font>Ch&uacute;ng t&ocirc;i kh&ocirc;ng muốn bạn cảm thấy giới hạn chỉ sử dụng phong c&aacute;ch mặc định.&nbsp;</font><font>Bạn c&oacute; thể thiết kế chủ đề của ri&ecirc;ng bạn với ch&uacute;ng t&ocirc;i&nbsp;</font></font><a href="http://uniformjs.com/downloads/theme-kit.zip"><font><font>bộ chủ đề</font></font></a><font><font>&nbsp;v&agrave; tạo ra hầu hết c&aacute;c m&atilde; bạn sẽ cần phải sử&nbsp;</font><a href="http://uniformjs.com/themer.html"><font>dụng m&aacute;y ph&aacute;t điện chủ</font></a><font>&nbsp;đề của ch&uacute;ng&nbsp;</font></font><a href="http://uniformjs.com/themer.html"><font><font>t&ocirc;i t&ugrave;y chỉnh .</font></font></a></p>\r\n	<p>\r\n		<font><font>Bạn cũng c&oacute; thể tải về c&aacute;c chủ đề được tạo ra bởi những người kh&aacute;c.&nbsp;</font><font>Dưới đ&acirc;y l&agrave; một số mục y&ecirc;u th&iacute;ch của của ch&uacute;ng t&ocirc;i:</font></font></p>\r\n	<p>\r\n		<a href="mailto:josh@pixelmatrixdesign.com?subject=I''d%20like%20to%20submit%20my%20theme" title=""><font><font>Gửi chủ đề của bạn ...</font></font></a></p>\r\n</div>\r\n<div id="contribute">\r\n	<h3>\r\n		<font><font>Đ&oacute;ng g&oacute;p</font></font></h3>\r\n	<p>\r\n		<font><font>C&oacute; những &yacute; tưởng cho đồng phục?&nbsp;</font><font>Muốn gửi một sửa chữa lỗi hoặc bản v&aacute; lỗi?&nbsp;</font><font>Ch&uacute;ng t&ocirc;i phối hợp thống nhất về GitHub, v&agrave; ch&uacute;ng t&ocirc;i ch&agrave;o đ&oacute;n bạn tham gia ch&uacute;ng t&ocirc;i&nbsp;</font></font><a href="http://github.com/pixelmatrix/uniform"><font><font>cũng Chơi thống nhất tr&ecirc;n GitHub .</font></font></a></p>\r\n</div>\r\n', 1310356752, 1310356752, 1, 5, 'uniform, form, theme');

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

CREATE TABLE IF NOT EXISTS `article_tag` (
  `nid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  KEY `nid` (`nid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_tag`
--

INSERT INTO `article_tag` (`nid`, `tid`) VALUES
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(3, 22),
(3, 23),
(3, 14),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 11),
(2, 19),
(2, 20),
(2, 21),
(5, 26),
(5, 27),
(5, 28);

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, NULL, NULL, 'N;'),
('Authenticated', 2, NULL, NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitemchild`
--


-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` int(11) unsigned DEFAULT NULL,
  `region` varchar(40) DEFAULT 'content',
  `theme` varchar(40) NOT NULL,
  `option` text,
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `url` text,
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`bid`, `title`, `label`, `description`, `type`, `region`, `theme`, `option`, `sort`, `status`, `url`, `display`) VALUES
(1, 'Demo Menu Portlet', 'Demo Menu Portlet', 'Portlet động, được cấu hình thông qua hàm callback.', 1, 'sidebar', 'gtel', 'a:2:{s:4:"root";s:1:"2";s:5:"level";s:1:"1";}', 0, 1, NULL, 0),
(2, 'Another Menu', 'Another Menu', 'Another Menu on the Fly.', 1, 'sidebar', 'gtel', 'a:2:{s:4:"root";s:1:"3";s:5:"level";s:1:"2";}', 0, 1, NULL, 0),
(3, 'Node Tags', 'Tags', 'All the tags associated with the Node type.', 2, 'sidebar', 'gtel', NULL, 0, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blocktheme`
--

CREATE TABLE IF NOT EXISTS `blocktheme` (
  `block` int(11) NOT NULL,
  `theme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blocktheme`
--


-- --------------------------------------------------------

--
-- Table structure for table `blocktype`
--

CREATE TABLE IF NOT EXISTS `blocktype` (
  `btid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `component` varchar(255) DEFAULT NULL,
  `callback` varchar(40) DEFAULT NULL,
  `viewfile` varchar(255) DEFAULT NULL,
  `config` text,
  PRIMARY KEY (`btid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `blocktype`
--

INSERT INTO `blocktype` (`btid`, `title`, `description`, `component`, `callback`, `viewfile`, `config`) VALUES
(1, 'Dynamic Menu Portlet', 'A dynamic menu portlet.\r\nThe Component should be application.models.WebMenu\r\nIt must have a call back function named getMenuData() to provide the view file with needed data.\r\nThe getMenuData() will have 2 arguments: The level of the menu that will be render, and the root of the menu tree.\r\nTo configure a block of this type, the Block module must configure through WebMenu::getMenuConfig() function.', 'application.models.WebMenu', 'getMenu', '//webmenu/menuportlet', NULL),
(2, 'Node TagWidget', 'Display all the Tags belongs to node.', NULL, NULL, '/node/tagportlet', NULL),
(3, 'Tree Menu Portlet', NULL, 'application.models.WebMenu', 'getMenu', '//webmenu/menuTreePortlet', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `root`, `lft`, `rgt`, `level`, `title`, `description`) VALUES
(1, 1, 1, 4, 1, 'Node', 'This category will be used as the root of the Node categories.\r\n\r\nBy add ENestedBehavior, we can easily create Tree-like structure, as of this model.'),
(2, 1, 2, 3, 2, 'Extension Demonstration', 'The node of this type will be used as demonstration for various kind of Extension.'),
(3, 3, 1, 18, 1, 'Article', 'All Article are using this Category to categorize its content.'),
(4, 3, 2, 5, 2, 'News', 'Regular updated news'),
(5, 3, 6, 9, 2, 'Tutorials', 'Tutorial from Yii Extension repository.'),
(6, 3, 10, 15, 2, 'Yii Extension Demo', 'Demonstration of various Yii Extensions'),
(7, 3, 7, 8, 3, 'Yii Cookbook', 'Article retrieved from Yii cookbook.'),
(8, 3, 3, 4, 3, 'Ubuntu', 'Ubuntu related News'),
(9, 3, 11, 12, 3, 'Widgets', 'All demo related to Widgets'),
(10, 3, 13, 14, 3, 'Behaviors', 'Behaviors Demonstration'),
(11, 3, 16, 17, 2, 'Yii ideas', 'Ideas on Yii development');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `entity` varchar(255) NOT NULL,
  `pkey` int(11) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `pkey` (`pkey`),
  KEY `entity` (`entity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `title`, `alias`, `description`, `body`, `createtime`, `updatetime`, `uid`, `cid`, `tags`) VALUES
(1, 'FreeSwitch 1.0.6', '', '\r\n	FreeSWITCH&trade; is an open source communications platform written in C from the ground up. Licensed under the MPL 1.1 and running natively on Windows, Mac OS X, Linux, *BSD, and other Unix flavors. In this way, users are given many choices on how and', '<p>\r\n	FreeSWITCH&trade; is an open source communications platform written in C from the ground up. Licensed under the <a class="external text" href="http://www.opensource.org/licenses/mozilla1.1.php" rel="nofollow" title="http://www.opensource.org/licenses/mozilla1.1.php">MPL 1.1</a> and running natively on Windows, Mac OS X, Linux, *BSD, and other Unix flavors. In this way, users are given many choices on how and where to run the software.</p>\r\n<p>\r\n	With a desire to not reinvent the wheel, it is designed to take advantage of as many existing software libraries as possible. It has a modular, extensible architecture, with only limited and necessary functionality in core. Optional modules can be employed to add virtually any functionality desired by the user.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<ul>\r\n	<li>\r\n		Default implementation is for a PBX or Softswitch.\r\n		<ul>\r\n			<li>\r\n				The core (<a class="mw-redirect" href="http://wiki.freeswitch.org/wiki/Libfreeswitch" title="Libfreeswitch">libfreeswitch</a>) can be <a href="http://wiki.freeswitch.org/wiki/Embedding_FreeSWITCH" title="Embedding FreeSWITCH">embedded</a> into almost any app that can use a .so or .dll.</li>\r\n			<li>\r\n				Transform it into a softphone, PBX, soft-switch or anything in between.</li>\r\n		</ul>\r\n	</li>\r\n	<li>\r\n		Modular system allows you to extend the system easily.\r\n		<ul>\r\n			<li>\r\n				Applications may be written in C/C++, Java, <a href="http://wiki.freeswitch.org/wiki/Mod_managed" title="Mod managed">.NET</a>, <a class="mw-redirect" href="http://wiki.freeswitch.org/wiki/Javascript" title="Javascript">Javascript/ECMAScript</a>, <a href="http://wiki.freeswitch.org/wiki/Mod_python" title="Mod python">Python</a>, <a href="http://wiki.freeswitch.org/wiki/Perl" title="Perl">Perl</a>, Ruby, PHP, <a class="mw-redirect" href="http://wiki.freeswitch.org/wiki/Lua" title="Lua">Lua</a>, and more!</li>\r\n			<li>\r\n				External systems can receive events from and/or control the switch over a TCP <a href="http://wiki.freeswitch.org/wiki/Mod_event_socket" title="Mod event socket">Event socket</a> with many language bindings and clients.</li>\r\n		</ul>\r\n	</li>\r\n	<li>\r\n		Handle thousands of concurrent channels with media on a standard PC.</li>\r\n	<li>\r\n		Interoperates with many different products and protocols.\r\n		<ul>\r\n			<li>\r\n				Such as <a class="external text" href="http://www.callweaver.org/" rel="nofollow" title="http://www.callweaver.org">CallWeaver</a> (formerly known as OpenPBX.org), <a class="external text" href="http://www.gnu.org/software/bayonne/" rel="nofollow" title="http://www.gnu.org/software/bayonne/">GNU Bayonne</a>, <a class="external text" href="http://yate.null.ro/" rel="nofollow" title="http://yate.null.ro/">Yate</a>, <a class="external text" href="http://www.sipfoundry.org/" rel="nofollow" title="http://www.sipfoundry.org">sipXecs</a> or <a class="external text" href="http://www.asterisk.org/" rel="nofollow" title="http://www.asterisk.org">Asterisk</a>.</li>\r\n			<li>\r\n				Supports SIP, SCCP, H.323, LDAP, Zeroconf, XMPP / Jingle, etc.</li>\r\n			<li>\r\n				With <a href="http://wiki.freeswitch.org/wiki/FreeTDM" title="FreeTDM">FreeTDM</a>, a BSD licensed TDM abstraction library it can interface with the PSTN as well.</li>\r\n		</ul>\r\n	</li>\r\n	<li>\r\n		Please see the complete <a href="http://wiki.freeswitch.org/wiki/Features" title="Features">Feature list</a> for more features.</li>\r\n	<li>\r\n		Supports <a href="http://wiki.freeswitch.org/wiki/Secure_RTP" title="Secure RTP">Secure RTP</a> (SRTP) and <a href="http://wiki.freeswitch.org/wiki/ZRTP" title="ZRTP">zRTP</a> (libzrtp).</li>\r\n</ul>\r\n', 1309949052, 1309949052, 1, 8, 'voip, freeswitch'),
(2, 'Unikey Keymap', '', '\r\n	Unikey, a greate software.', '<p>\r\n	Unikey, a greate software.</p>\r\n', 1309949418, 1309949418, 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `document_tag`
--

CREATE TABLE IF NOT EXISTS `document_tag` (
  `nid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  KEY `nid` (`nid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_tag`
--

INSERT INTO `document_tag` (`nid`, `tid`) VALUES
(1, 24),
(1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` varchar(80) DEFAULT NULL,
  `basename` varchar(45) DEFAULT NULL,
  `extension` varchar(6) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `path` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `images`
--


-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `template` varchar(255) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `root`, `lft`, `rgt`, `level`, `label`, `description`, `url`, `template`, `visible`) VALUES
(1, 1, 1, 2, 1, 'Site Navigation', 'This is the main website menu.', '#navigation', NULL, 1),
(2, 2, 1, 8, 1, 'Dịch vụ cáp quang FTTH', 'Cung cấp các thông tin liên quan đến dịch vụ cáp quang FTTH.', '#ftth', NULL, 1),
(3, 3, 1, 8, 1, 'Dịch vụ thuê kênh riêng', 'Dịch vụ thuê kênh riêng.', '#subscriber', NULL, 1),
(4, 4, 1, 8, 1, 'Dịch vụ truyền hình hội nghị', 'Dịch vụ truyền hình hội nghị.', '#videoconf', NULL, 1),
(7, 2, 2, 3, 2, 'Bảng giá', 'Bảng giá cho dịch vụ FTTH', 'table-of-price', NULL, 1),
(8, 2, 4, 5, 2, 'Giới thiệu dịch vụ', 'Giới thiệu dịch vụ cung cấp đường truyền FTTH', 'duong-truyen-ftth', NULL, 1),
(9, 2, 6, 7, 2, 'Đăng ký dịch vụ', 'Thủ tục đăng ký dịch vụ.', 'dang-ky-dich-vu', NULL, 1),
(10, 3, 2, 3, 2, 'Giới thiệu', 'Giới thiệu về dịch vụ cho thuê kênh riêng.', 'gioi-thieu-thue-kenh', NULL, 1),
(11, 3, 4, 5, 2, 'Bảng giá', 'Bảng giá của dịch vụ cho thuê kênh riêng.', 'bang-gia-thue-kenh', NULL, 1),
(12, 4, 2, 3, 2, 'Giới thiệu', 'Giới thiệu dịch vụ truyền hình hội nghị.', 'video-conf', NULL, 1),
(13, 4, 4, 5, 2, 'Bảng giá', 'Bảng giá của dịch vụ Truyền hình hội nghị.', 'price-table-video', NULL, 1),
(14, 3, 6, 7, 2, 'Đăng ký dịch vụ', 'Hướng dẫn đăng ký dịch vụ cho thuê kênh riêng.', 'dangky-thue-kenh', NULL, 1),
(15, 4, 6, 7, 2, 'Đăng ký dịch vụ', 'Đăng ký dịch vụ truyền hình', 'dangky-truyen-hinh', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_adjacency`
--

CREATE TABLE IF NOT EXISTS `menu_adjacency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(2) NOT NULL,
  `tooltip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visible` int(1) NOT NULL,
  `task` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_parent` (`parent_id`),
  KEY `task` (`task`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `menu_adjacency`
--

INSERT INTO `menu_adjacency` (`id`, `parent_id`, `title`, `position`, `tooltip`, `url`, `icon`, `visible`, `task`) VALUES
(1, NULL, 'Home', 0, NULL, '#', 'house.png', 1, NULL),
(2, 1, 'Profile', 1, 'view your profile', '', 'user.png', 1, NULL),
(3, 2, 'View Profile', 0, 'view the details of your profile', '#', 'user_go.png', 1, 'User.Profile.Profile'),
(4, 2, 'Update Profile', 1, 'update the details of your profile', '#', 'user_edit.png', 1, 'User.ProfileField.Update'),
(5, 2, 'Change Password', 2, 'change your password access to the system', '#', 'lock_edit.png', 1, 'User.Profile.Changepassword'),
(6, NULL, 'Personnel Management', 1, 'module to manage all the information about applicants and employees', '', 'folder_user.png', 1, NULL),
(7, 6, 'Manage Personnel', 1, 'list, add, edit, or delete personnel', '#', 'group_gear.png', 1, 'User.Admin.Admin'),
(8, 7, 'Add Personnel', 1, 'create a new record of a personnel', '#', 'user_add.png', 1, 'User.Admin.Create'),
(9, 7, 'List Personnel', 0, 'list all the personnel available in the database', '#', 'gif/list_users.gif', 1, 'User.Default.Index'),
(11, 13, 'Menu Management', 3, 'add.edit.delete, or arrange system menu options', '', 'cog.png', 1, NULL),
(12, 13, 'System Access Rights', 2, 'assign permissions to roles, tasks,or permissions ', '', 'key.png', 1, NULL),
(13, NULL, 'Back Office', 3, 'system maintenance module', '', 'wrench_orange.png', 1, NULL),
(14, 26, 'Roles', 1, 'view, create, update or delete system role', '#', 'group.png', 1, NULL),
(15, 14, 'Add Role', 0, 'create a new role', '#', 'group_add.png', 1, NULL),
(16, 13, 'Reference Tables', 0, 'manage all tables used as reference', '', 'table_multiple.png', 1, NULL),
(19, 16, 'Municipalities', 0, 'add,edit, or delete Municipalities', '#', 'table.png', 1, 'Admin.Municipality.Index'),
(20, 21, 'Add Menu', 1, 'create a new module for the system', '#', 'cog_add.png', 1, NULL),
(21, 11, 'Manage Menu', 0, 'search, list, edit, or delete all the menus', '#', 'cog_edit.png', 1, NULL),
(22, 21, 'Arrange Menus', 0, 'change the order of the menus', '#', 'cog_edit.png', 1, NULL),
(23, 12, 'Permissions', 1, 'manage permissions', '#', 'folder_key.png', 1, NULL),
(24, 23, 'Generate Permissions', 0, 'select items which needs permissions', '#', 'folder_add.png', 1, NULL),
(25, 26, 'Assignments', 0, 'manage assignments', '#', 'gif/key_go.gif', 1, NULL),
(26, 12, 'Manage Auth Items', 3, 'add, edit, or delete authorization items', '', 'gif/application_key.gif', 1, NULL),
(27, 26, 'Tasks', 2, 'manage tasks', '#', 'application_key.png', 1, NULL),
(28, 27, 'Add Task', 0, 'create a new task', '#', 'application_key.png', 1, NULL),
(29, 26, 'Operations', 3, 'manage operations', '#', 'shield.png', 1, NULL),
(30, 29, 'Add Operation', 0, 'create a new operation', '#', 'shield_add.png', 1, NULL),
(31, 33, 'Manage Profile Fields', 0, 'manage fields for personnel profile', '#', '', 1, NULL),
(32, 31, 'Add Profile Field', 0, 'create a new profile field', '#', '', 1, NULL),
(33, 13, 'Profile Table Maintenance', 1, 'manage everything related to profile fields', '', '', 1, NULL),
(34, 33, 'Profile Fields Group', 1, 'manage profile fields grouping', '#', '', 1, NULL),
(35, 34, 'Manage Fields Group', 0, 'manage profile fields grouping', '#', '', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_nested`
--

CREATE TABLE IF NOT EXISTS `menu_nested` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `visible` int(1) NOT NULL,
  `task` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `menu_nested`
--

INSERT INTO `menu_nested` (`id`, `title`, `lft`, `rgt`, `url`, `visible`, `task`) VALUES
(1, 'CEO', 1, 16, '', 1, ''),
(2, 'Senior managers', 2, 15, '#', 1, ''),
(3, 'Technical team leader', 3, 6, '#', 1, ''),
(4, 'Technical team', 4, 5, '#', 1, ''),
(5, 'Sales team leader', 7, 10, '#', 1, ''),
(6, 'Sales team', 8, 9, '#', 1, ''),
(7, 'Customer service team leader', 11, 14, '#', 1, ''),
(8, 'Customer service team', 12, 13, '#', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `news`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_tag`
--

CREATE TABLE IF NOT EXISTS `news_tag` (
  `nid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  KEY `nid` (`nid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_tag`
--


-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `node`
--

INSERT INTO `node` (`id`, `title`, `alias`, `description`, `body`, `createtime`, `updatetime`, `uid`, `cid`, `tags`) VALUES
(1, 'Node Content', '', '\r\n	Node\r\n\r\n	C&aacute;c t&iacute;nh năng của Node:\r\n\r\n	\r\n		Li&ecirc;n kết với WebMenu để cung cấp c&aacute;c menu tr&ecirc;n hệ thống.\r\n	\r\n		Li&ecirc;n kết với Category để ph&acirc;n loại nội dung.\r\n	\r\n		Li&ecirc;n kết với Tags để ph&acirc;n loại dưới dạng', '<h2>\r\n	Node</h2>\r\n<p>\r\n	C&aacute;c t&iacute;nh năng của Node:</p>\r\n<ul>\r\n	<li>\r\n		Li&ecirc;n kết với WebMenu để cung cấp c&aacute;c menu tr&ecirc;n hệ thống.</li>\r\n	<li>\r\n		Li&ecirc;n kết với Category để ph&acirc;n loại nội dung.</li>\r\n	<li>\r\n		Li&ecirc;n kết với Tags để ph&acirc;n loại dưới dạng thẻ.</li>\r\n	<li>\r\n		Li&ecirc;n kết với Comment để th&ecirc;m lời b&igrave;nh luận.</li>\r\n	<li>\r\n		Xử dụng EavBehavior để th&ecirc;m c&aacute;c trường dữ liệu t&ugrave;y th&iacute;ch.</li>\r\n</ul>\r\n<h3>\r\n	WebMenu</h3>\r\n<p>\r\n	WebMenu c&oacute; cấu tr&uacute;c dạng c&acirc;y, được d&ugrave;ng để tổ hợp c&aacute;c menu tr&ecirc;n hệ thống.</p>\r\n<p>\r\n	WebMenu cung cấp chức năng cho block Menu, cho ph&eacute;p người d&ugrave;ng tạo 1 menu từ 1 nh&aacute;nh menu, v&agrave; số cấp tr&ecirc;n nh&aacute;nh đ&oacute;.</p>\r\n<h3>\r\n	Category</h3>\r\n<p>\r\n	Category cho ph&eacute;p ph&acirc;n loại dữ liệu dưới dạng <em>Chuy&ecirc;n mục</em>. Mỗi 1 chuy&ecirc;n mục c&oacute; thể c&oacute; nhiều kiểu Node kh&aacute;c nhau.</p>\r\n<p>\r\n	Node cho ph&eacute;p cấu h&igrave;nh c&acirc;y chuy&ecirc;n mục sẽ sử dụng để ph&acirc;n loại nội dung cho n&oacute;.</p>\r\n<h3>\r\n	Tags</h3>\r\n<p>\r\n	Tag l&agrave; c&aacute;ch ph&acirc;n loại nhiều - nhiều, cho ph&eacute;p ph&acirc;n loại nội dung dựa v&agrave;o 1 bảng tham chiếu thứ 3, giống như quan hệ MANY_MANY m&agrave; Yii cung cấp.</p>\r\n<p>\r\n	Tags được x&acirc;y dựng nhờ t&iacute;nh năng ETaggableBehavior.</p>\r\n', 1309857850, 1309879401, 1, 2, 'node, tags, category, webmenu'),
(3, 'HTML 5 Page Structure', '', '\r\n	What are the tags of structure of an HTML page in the specification 5?\r\n\r\n	It can be summarized as follows:\r\n\r\n&lt;DOCTYPE html&gt;\r\n&lt;html lang=&quot;en&quot;&gt;\r\n  &lt;head&gt;\r\n    &lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/h', '<p>\r\n	What are the tags of structure of an HTML page in the specification 5?</p>\r\n<p>\r\n	It can be summarized as follows:</p>\r\n<pre>\r\n<code>&lt;DOCTYPE html&gt;\r\n&lt;html lang=&quot;en&quot;&gt;\r\n  &lt;head&gt;\r\n    &lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=utf-8&quot; /&gt;\r\n    &lt;meta name=&quot;&quot; content=&quot;&quot;&gt;\r\n  &lt;/head&gt;\r\n&lt;/html&gt;</code></pre>\r\n<p>\r\n	What changes with HTML 5? The format is much simplified compared to the previous standard and new tags are offered.</p>\r\n<h2>\r\n	The DOCTYPE</h2>\r\n<p>\r\n	The document type has been introduced to mark the difference between the old browsers which followed the usual format in the 90s and newer browsers that are closer to the HTML specifications 3 then 4 and 5.</p>\r\n<p>\r\n	On most browser, a missing DOCTYPE is not equivalent to the HTML 5 simplified format or the previous doctypes.<br />\r\n	The lack means for Internet Explorer that the page is designed for older browsers. This may not make any difference if the latoyout is simple, consisting solely of titles and paragraphs, but if we include tables, layers and other elements, the rendering could totally change.</p>\r\n<h2>\r\n	Language</h2>\r\n<p>\r\n	The lang attribute is not for browsers, but rather to the processing tools that must understand contents according to their language.<br />\r\n	And among these tools, search engines are not included, they ignore this attribute and prefer to rely on the content to know the language.</p>\r\n<p>\r\n	It can therefore be considered optional.</p>\r\n<h2>\r\n	Head</h2>\r\n<p>\r\n	The tag contains several types of elements:</p>\r\n<ul>\r\n	<li>\r\n		Encoding with the meta tag or charset.</li>\r\n	<li>\r\n		The title of the page.</li>\r\n	<li>\r\n		Links with the link tag.</li>\r\n	<li>\r\n		And other indications by metas.</li>\r\n</ul>\r\n<h3>\r\n	Encoding</h3>\r\n<p>\r\n	The most common tag has the following form:</p>\r\n<pre>\r\n&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=utf-8&quot;&gt;</pre>\r\n<p>\r\n	It defines the content type, its format that is generally text/html and its encoding, usually the utf8 charset.<br />\r\n	This tag is for the server that notifies the browser. It may be omitted if the server is configured, for example through .htaccess, to assign the format to the pages forf a given extension, like html.</p>\r\n<p>\r\n	This tag should be the first in the HEAD section, because the server will process the text above as ASCII with no specific format that it only known once the tag is analyzed.</p>\r\n<p>\r\n	This basic format is generally sufficient for all situations. There are other charsets, like iso-8859-1, but they add nothing more in the Latin world. For pages in Chinese or Japanese it is different.</p>\r\n<p>\r\n	Care must be taken however when you include dynamic content that must be encoded using the same charset.</p>\r\n<p>\r\n	HTML 5 can simplify the encoding:</p>\r\n<pre>\r\n&lt;meta charset=utf-8 &gt;</pre>\r\n<p>\r\n	This was actually implemented before HTML 5 but was not previously part of the specification. The quotes are unnecessary.</p>\r\n<p>\r\n	HTML is assumed by default, and it is only needed to specify the charset. It remains to verify that the page code is in this format, which is not necessarily automatic with all HTML editors.</p>\r\n<h3>\r\n	Links</h3>\r\n<p>\r\n	Many links can be specified in the header. Some are essential to the browser as the link to a style sheet or the RSS feed, or the favicon.</p>\r\n<p>\r\n	Others are optional as the prefetch value which loads a page in the background, and speed up the display.</p>\r\n<h4>\r\n	Sample of links</h4>\r\n<p>\r\n	Favicon</p>\r\n<pre>\r\n&lt;link rel=&quot;icon&quot; type=&quot;image/gif&quot; href=&quot;/favicon.gif&quot; /&gt;</pre>\r\n<p>\r\n	Stylesheet</p>\r\n<pre>\r\n&lt;link rel=&quot;stylesheet&quot;  type=&quot;text/css&quot; href=&quot;style.css&quot;&gt;</pre>\r\n<p>\r\n	RSS or Atom</p>\r\n<pre>\r\n&lt;link rel=&quot;alternate&quot; type=&quot;application/rss+xml&quot; href=&quot;&quot; title=&quot;&quot;&gt;</pre>\r\n<p>\r\n	Other common attributes are <em>nofollow</em> that tells search engines not to follow links on the page.</p>\r\n<h2>\r\n	Content structure</h2>\r\n<p>\r\n	In HTML 4 there is no structure specialized tags, the content is structured with &lt;div&gt; &lt;span&gt; and other containers.<br />\r\n	HTML 5 introduces multiple tags to help represent the usual structure of documents.</p>\r\n<h4>\r\n	&lt;header&gt;</h4>\r\n<p>\r\n	Contains an introduction to a part or the whole page.</p>\r\n<h4>\r\n	&lt;footer&gt;</h4>\r\n<p>\r\n	Contains information that are usually placed at the end of a section. We can put it at the end of a section or page, but also anywhere in the section.<br />\r\n	For example it contains a link on the index, which can be placed below the title.</p>\r\n<h4>\r\n	&lt;section&gt;</h4>\r\n<p>\r\n	Sections mark out parts of content. It is then up to the webmaster to associate a style sheet or using them dynamically in scripts.<br />\r\n	Very basically, we can frame a section with a border, or separate it from the above by a space.</p>\r\n<h4>\r\n	&lt;hgroup&gt;</h4>\r\n<p>\r\n	Represents the header of a section. The &lt;header&gt; tag may contain at the beginning a &lt;hgroup&gt; tag.</p>\r\n<h4>\r\n	&lt;nav&gt;</h4>\r\n<p>\r\n	This container is intended to enclose a group of links.</p>\r\n<h4>\r\n	&lt;article&gt;</h4>\r\n<p>\r\n	Denotes a typical content that can be found on different pages, or even different sites. This can be a forum post, a newspaper article and this is for tools to extract more easily the content (by separating the unnecessary data such as navigation menus).</p>\r\n<h4>\r\n	&lt;aside&gt;</h4>\r\n<p>\r\n	To delimit something separate to the actual content, and may define a sidebar.</p>\r\n<h4>\r\n	&lt;address&gt;</h4>\r\n<p>\r\n	Contains contact information, eg name of the author.</p>\r\n<h4>\r\n	&lt;mark&gt;</h4>\r\n<p>\r\n	Used to mark a portion of a text, highlight, as the old &lt;strong&gt; but more general.</p>\r\n<p>\r\n	There are many other semantic tags, which can be found described in the documents in references.</p>\r\n', 1309858954, 1309858954, 1, 1, 'html5, page elements, advanced website');

-- --------------------------------------------------------

--
-- Table structure for table `node_tag`
--

CREATE TABLE IF NOT EXISTS `node_tag` (
  `nid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  KEY `nid` (`nid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node_tag`
--

INSERT INTO `node_tag` (`nid`, `tid`) VALUES
(3, 7),
(3, 8),
(3, 9),
(1, 4),
(1, 2),
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`user_id`, `lastname`, `firstname`, `birthday`) VALUES
(1, 'Admin', 'Administrator', '0000-00-00'),
(2, 'Demo', 'Demo', '0000-00-00'),
(3, 'Dinh Trung', 'Nguyen', '1985-01-14'),
(4, 'One', 'Teacher', '0000-00-00'),
(5, 'Hai', 'Teacher', '0000-00-00'),
(6, 'One', 'Manager', '0000-00-00'),
(7, 'Hai', 'Manager', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_fields`
--

CREATE TABLE IF NOT EXISTS `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'birthday', 'Birthday', 'DATE', 0, 0, 2, '', '', '', '', '0000-00-00', 'UWjuidate', '{"ui-theme":"redmond"}', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rights`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `category`, `key`, `value`) VALUES
(1, 'theme', 'perPage', 's:2:"20";'),
(2, 'theme', 'serverEmail', 's:0:"";'),
(3, 'theme', 'contactEmail', 's:0:"";'),
(4, 'theme', 'theme', 's:4:"gtel";'),
(5, 'theme', 'layout', 'N;'),
(6, 'theme', 'siteName', 's:13:"Internet GTel";'),
(7, 'theme', 'siteSlogan', 'N;'),
(8, 'theme', 'siteLogo', 's:0:"";'),
(9, 'article', 'image', 's:0:"";'),
(10, 'article', 'cid', 's:1:"3";'),
(11, 'article', 'alias', 's:20:"webroot.files.upload";'),
(12, 'document', 'alias', 's:21:"webroot.files.uploads";'),
(13, 'document', 'image', 's:0:"";'),
(14, 'document', 'cid', 's:1:"3";');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `frequency`) VALUES
(1, 'category', 2),
(2, 'tags', 2),
(3, 'webmenu', 2),
(4, 'node', 2),
(5, 'content', 1),
(6, 'duplicate', 1),
(7, 'html5', 2),
(8, 'page elements', 2),
(9, 'advanced website', 2),
(10, 'processor', 2),
(11, 'file', 3),
(12, 'image', 2),
(13, 'behavior', 2),
(14, 'model', 3),
(15, 'active record', 2),
(16, 'activerecord', 2),
(17, 'array', 2),
(18, 'data', 2),
(19, 'find', 2),
(20, 'validate', 2),
(21, 'save', 2),
(22, 'configure', 2),
(23, 'config', 2),
(24, 'voip', 2),
(25, 'freeswitch', 2),
(26, 'uniform', 2),
(27, 'form', 2),
(28, 'theme', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `root`, `lft`, `rgt`, `level`, `title`, `description`) VALUES
(1, NULL, 1, 4, 1, 'Mobile phones', 'Mobile phones.'),
(2, NULL, 2, 3, 2, 'Blackberry', ''),
(3, 3, 1, 14, 1, 'Cars', ''),
(4, 3, 2, 3, 2, 'Ferrari', ''),
(5, 5, 1, 6, 1, 'Yii Extension', 'Collection of Yii Extensions'),
(6, 5, 2, 3, 2, 'Menu', 'Menu related Extension'),
(7, 3, 4, 5, 2, 'Mercedes', 'Mercedes Benz'),
(8, 3, 6, 7, 2, 'Toyota', 'Toyota Cars'),
(9, 3, 8, 13, 2, 'BMW', 'BMW Cars'),
(10, 3, 9, 10, 3, '2012 BMW 6 Series', '5 stars (2)\r\n	\r\n\r\nMSRP\r\n    $90,500\r\nInvoice\r\n    $83,260'),
(11, 3, 11, 12, 3, '2012 BMW 7 Series', '5 stars (1)\r\n	\r\n\r\nMSRP\r\n    $71,000 - $91,200\r\nInvoice\r\n    $65,320 - $83,905'),
(12, 5, 4, 5, 2, 'Nested Set Behavior', 'This is the advanced way to create and manage tree menu.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', 1261146094, 1310355386, 1, 1),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', 1261146096, 0, 0, 1),
(3, 'ndtrung', 'e10adc3949ba59abbe56e057f20f883e', 'ndtrung@istt.com.vn', 'ee1ee8aaa2b5eb52e0caac370172814b', 1307011935, 0, 0, 0),
(4, 'teacher1', 'e10adc3949ba59abbe56e057f20f883e', 'teacher1@yiiedupro.com', 'bf09249421f3c9d8e0feab86bfce0757', 1308593633, 1308593633, 0, 1),
(5, 'teacher2', 'e10adc3949ba59abbe56e057f20f883e', 'teacher2@yiiedupro.com', '5eb6c4db0584b5ce468a0249044e567d', 1308593660, 1308593660, 0, 1),
(6, 'manager1', 'e10adc3949ba59abbe56e057f20f883e', 'manager1@edupro.com', 'f547e7a74e9dad726cfc318262434f29', 1308593687, 1308593687, 0, 1),
(7, 'manager2', 'e10adc3949ba59abbe56e057f20f883e', 'manager2@yiiedupro.com', 'bd10823945c501005226dc2db67d162e', 1308593711, 1308593711, 0, 1);
