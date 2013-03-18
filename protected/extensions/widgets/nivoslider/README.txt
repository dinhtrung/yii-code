Usage 

Put the follow code into your views.

$this->widget('application.extensions.nivoslider.CNivoSlider', array(
    'images'=>array( //@array images with images arrays.
        array('src'=>'path/to/image'), //only display image.
        array('src'=>'path/to/image', 'caption'=>''), //display image and nivo slider caption.
        array('src'=>'path/to/image', 'url'=>array('')), //display image with link.
        array('src'=>'path/to/image', 'url'=>array(''), 'caption'=>''), //display image with nivo slider caption and link reference.
        ),
    )
);
Try others combinations. See configuration parameters bellow. 

Parameters you could set on CNivoSlider 

id              =   @string, the id of the nivo slider div. Defaults set to dynamic generation.
htmlOptions     =   @array, the html options of the nivo slider div. Defaults set to null.
fancy           =   @boolean, toggle the defaults fancy style. Defaults set to true.
cssFile         =   @string, path to custom style sheet.  Defaults set to NULL.
config          =   @array, configuration parameters of nivo slider jquery. Defaults set to basic configuration.
images          =   @array containing the images arrays of the widget. Defaults set to NONE.
Goto Nivo Slider website to check nivo slider configuration parameters. 

Parameters you could set inside images array 

src         =   @string, the path of image,
caption     =   @string, the nivo slider caption of image,
imageOptions=   @array, the html options of image tag
url         =   @array or @string, the path of link,
linkOptions =   @array, the html options of link tag