<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php

    /////////////////////////////////////////////////////////////////////////////

    // 1-Step Gallery
    // version .2
    // Alesh Houdek, http://alesh.com
    //
    // Include this file in a directory of images and boom: instant gallery.
    // Some optional configuration

    // Title to be displayed
    $title = "Photos";

    // Directory to process. '.' means current.
    $directory  = '.';

    // Allowed extensions. Case insensitive.
    $extensions = ["jpg", "jpeg", "gif", "png"];

    /////////////////////////////////////////////////////////////////////////////

  ?>
  <title><?php echo $title; ?></title>
  <style>
    html {
      overflow-y: scroll;
      height: 102%;
    }
    body {
      background-color: silver;
      margin: 0;
      padding: 0;
      font-family: Helvetica, sans-serif;
    }
    header {
      color:white;
      margin: 0;
      padding: 10px 20px;
      background-color: black;
    }
    h1 {
      margin: 0;
      display: inline-block;
    }
    .size-adjust {
      float:right;
      /*margin-right: 20px;*/
      margin-top: 10px;
    }
    p {
      margin-left: 10px;
      font-size: 12px;
      margin-bottom: 10px;
    }
    .wrapper {
      /*margin-right: 10px;*/
    }
    .thumbnail {
      width: 250px;
      height: auto;
      margin-left: 10px;
      margin-top: 10px;
      padding: 10px;
      /*border: 1px solid black;*/
      background-color: white;
    }

    /* lightbox2 css*/
    .lb-loader,.lightbox{text-align:center;line-height:0}body:after{content:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/close.png) url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/loading.gif) url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/prev.png) url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/next.png);display:none}.lb-dataContainer:after,.lb-outerContainer:after{content:"";clear:both}body.lb-disable-scrolling{overflow:hidden}.lightboxOverlay{position:absolute;top:0;left:0;z-index:9999;background-color:#000;filter:alpha(Opacity=80);opacity:.8;display:none}.lightbox{position:absolute;left:0;width:100%;z-index:10000;font-weight:400}.lightbox .lb-image{display:block;height:auto;max-width:inherit;border-radius:3px}.lightbox a img{border:none}.lb-outerContainer{position:relative;background-color:#fff;width:250px;height:250px;margin:0 auto;border-radius:4px}.lb-loader,.lb-nav{position:absolute;left:0}.lb-outerContainer:after{display:table}.lb-container{padding:4px}.lb-loader{top:43%;height:25%;width:100%}.lb-cancel{display:block;width:32px;height:32px;margin:0 auto;background:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/loading.gif) no-repeat}.lb-nav{top:0;height:100%;width:100%;z-index:10}.lb-container>.nav{left:0}.lb-nav a{outline:0;background-image:url(data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)}.lb-next,.lb-prev{height:100%;cursor:pointer;display:block}.lb-nav a.lb-prev{width:34%;left:0;float:left;background:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/prev.png) left 48% no-repeat;filter:alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-prev:hover{filter:alpha(Opacity=100);opacity:1}.lb-nav a.lb-next{width:64%;right:0;float:right;background:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/next.png) right 48% no-repeat;filter:alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-next:hover{filter:alpha(Opacity=100);opacity:1}.lb-dataContainer{margin:0 auto;padding-top:5px;width:100%;-moz-border-radius-bottomleft:4px;-webkit-border-bottom-left-radius:4px;border-bottom-left-radius:4px;-moz-border-radius-bottomright:4px;-webkit-border-bottom-right-radius:4px;border-bottom-right-radius:4px}.lb-dataContainer:after{display:table}.lb-data{padding:0 4px;color:#ccc}.lb-data .lb-details{width:85%;float:left;text-align:left;line-height:1.1em}.lb-data .lb-caption{font-size:13px;font-weight:700;line-height:1em}.lb-data .lb-number{display:block;clear:left;padding-bottom:1em;font-size:12px;color:#999}.lb-data .lb-close{display:block;float:right;width:30px;height:30px;background:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/close.png) top right no-repeat;text-align:right;outline:0;filter:alpha(Opacity=70);opacity:.7;-webkit-transition:opacity .2s;-moz-transition:opacity .2s;-o-transition:opacity .2s;transition:opacity .2s}.lb-data .lb-close:hover{cursor:pointer;filter:alpha(Opacity=100);opacity:1}

  </style>
</head>
<body>
  <header>
    <h1><?php echo $title; ?></h1>
    <input id="size-adjust" class="size-adjust" type="range" min="80" max="1000" value="250" />
  </header>

  <div class="wrapper">

    <?php

      $files = scandir($directory, 1);

      foreach ($extensions as $key => $value) {
        $extensions[$key] = strtoupper($value);
      }

      foreach ($files as $key => $value) {
        if (in_array(strtoupper(pathinfo($value)['extension']), $extensions)) {
          $images[] = $value;
          // echo "<img src='".$value."' class='thumbnail' />\n\n";
          echo "<a href='", $value, "' data-lightbox='photos' ><img src='", $value, "' class='thumbnail' /></a>\n\n";
        }
      }

    ?>

    <p><strong>1-Step Gallery</strong> by <a href="http://alesh.com">Alesh Houdek</a>. Uses <a href="http://lokeshdhakar.com/projects/lightbox2/">Lightbox2</a>.</p>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox-plus-jquery.min.js"></script>

  <script>

    $('#size-adjust').attr("max", $(window).width() - 40);

    $('#size-adjust').on("chnage mousemove", function() {
      $('.thumbnail').css("width", $(this).val());
    });

  </script>

</body>
</html>