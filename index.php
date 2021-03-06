<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <?php

    /////////////////////////////////////////////////////////////////////////////

    // 1-Step Gallery
    // version .4
    // Alesh Houdek, http://alesh.com
    //
    // Include this file in a directory of images and boom: instant gallery.
    //
    // Some optional configuration:

    // Title to be displayed. Will use directory name if left blank.
    $title = "";

    // Optional message
    $message = "";

    // Show filenames
    $show_file_names = true;

    // Convert filename to readable caption
    $convert_filenames = true;

    // Allowed extensions. Case insensitive.
    $extensions = ["jpg", "jpeg", "gif", "png"];

    // Default thumbnail size
    $thumb_start = 250;

    // Image border size
    $border = 10;

    /////////////////////////////////////////////////////////////////////////////

    function remove_gunk($input) {
      $remove = array("-", "_");
      $input = str_replace($remove, " ", $input);
      $input = ucfirst($input);
      $period_position = strpos($input, ".");
      if ($period_position) {
        $input = substr($input, 0, $period_position);
      }
      return $input;
    }

    if ($title == "") {
      $url = explode("/", $_SERVER['REQUEST_URI']);
      $title = remove_gunk($url[count($url)-2]);
    }

  ?>
  <title><?php echo $title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
  <style>
    html {
      height: 102%; /*otherwise the scroll bar will appear/disapear on resize*/
    }
    body {
      background-color: silver;
      margin: 0;
      padding: 0;
      font-family: Helvetica, sans-serif;
    }
    header {
      position: fixed;
      height: 20px;
      width: 100%;
      color:white;
      margin: 0;
      padding: 10px 20px 12px;
      background-color: #444;
    }
    h1 {
      margin: 0;
      display: inline-block;
      font-size: 20px;
      font-weight: normal;
    }
    .size-adjust-wrapper {
      float:right;
      margin-right: 40px;
      margin-top: 4px;
    }
    .size-adjust {
      float: left;
      margin: 0 8px;
    }
    .small-rect, .large-rect {
      float:left;
      border: 1px solid white;
      background-color: #888;
      width: 10px;
      height: 8px;
      margin-top: 3px;
    }
    .large-rect {
      width: 15px;
      height: 12px;
      margin-top: 1px;
    }
    a {
      color: black;
    }
    .wrapper {
      padding-top: 50px;
    }

    .folder, .border {
      display: inline-block;
      margin-left: 10px;
      margin-top: 10px;
      background-color: silver;
<?php if ($border >= 2) {
        echo "padding: ", $border, "px;";
        echo "background-color: white;";
      } else {
        echo "padding: 0;";
      }
?>
    }

    .folder {
      background-color: #eee;
    }
    .thumbnail, .folder a {
      display: block;
      width: <?php echo $thumb_start; ?>px;
      height: auto;
<?php if ($border >= 2) {
        echo "padding: 0;";
      } else {
        echo "padding: ", $border, "px;";
        echo "background-color: white;";
      }
?>
    }
    .caption {
      width: 250px;
      font-size: 12px;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      margin: 6px 0 -2px;
    }
    .message {
      margin-left: 10px;
      margin-right: 10px;
    }
    .credit {
      margin-left: 10px;
      font-size: 12px;
      margin-bottom: 10px;
    }

    /* lightbox2 css*/
    .lb-loader,.lightbox{text-align:center;line-height:0}body:after{content:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/close.png) url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/loading.gif) url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/prev.png) url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/next.png);display:none}.lb-dataContainer:after,.lb-outerContainer:after{content:"";clear:both}body.lb-disable-scrolling{overflow:hidden}.lightboxOverlay{position:absolute;top:0;left:0;z-index:9999;background-color:#000;filter:alpha(Opacity=80);opacity:.8;display:none}.lightbox{position:absolute;left:0;width:100%;z-index:10000;font-weight:400}.lightbox .lb-image{display:block;height:auto;max-width:inherit}.lightbox a img{border:none}.lb-outerContainer{position:relative;background-color:#fff;width:250px;height:250px;margin:0 auto}.lb-loader,.lb-nav{position:absolute;left:0}.lb-outerContainer:after{display:table}.lb-container{padding:<?php echo $border; ?>px}.lb-loader{top:43%;height:25%;width:100%}.lb-cancel{display:block;width:32px;height:32px;margin:0 auto;background:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/loading.gif) no-repeat}.lb-nav{top:0;height:100%;width:100%;z-index:10}.lb-container>.nav{left:0}.lb-nav a{outline:0;background-image:url(data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)}.lb-next,.lb-prev{height:100%;cursor:pointer;display:block}.lb-nav a.lb-prev{width:34%;left:0;float:left;background:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/prev.png) left 48% no-repeat;filter:alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-prev:hover{filter:alpha(Opacity=100);opacity:1}.lb-nav a.lb-next{width:64%;right:0;float:right;background:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/next.png) right 48% no-repeat;filter:alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-next:hover{filter:alpha(Opacity=100);opacity:1}.lb-dataContainer{margin:0 auto;padding-top:5px;width:100%;-moz-border-radius-bottomleft:4px;-webkit-border-bottom-left-radius:4px;border-bottom-left-radius:4px;-moz-border-radius-bottomright:4px;-webkit-border-bottom-right-radius:4px;border-bottom-right-radius:4px}.lb-dataContainer:after{display:table}.lb-data{padding:0 4px;color:#ccc}.lb-data .lb-details{width:85%;float:left;text-align:left;line-height:1.1em}.lb-data .lb-caption{font-size:13px;font-weight:700;line-height:1em}.lb-data .lb-number{display:block;clear:left;padding-bottom:1em;font-size:12px;color:#999}.lb-data .lb-close{display:block;float:right;width:30px;height:30px;background:url(https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/images/close.png) top right no-repeat;text-align:right;outline:0;filter:alpha(Opacity=70);opacity:.7;-webkit-transition:opacity .2s;-moz-transition:opacity .2s;-o-transition:opacity .2s;transition:opacity .2s}.lb-data .lb-close:hover{cursor:pointer;filter:alpha(Opacity=100);opacity:1}

  </style>
</head>
<body>
  <header>
    <h1><?php echo $title; ?></h1>
    <div class="size-adjust-wrapper">
      <div class="icon small-rect"></div>
      <input id="size-adjust" class="size-adjust" type="range" min="80" max="1000" value="<?php echo $thumb_start; ?>" title="Drag to adjust size"/>
      <div class="icon large-rect"></div>
    </div>
  </header>

  <div class="wrapper">

<?php

      class directory_entry {
        public $name;
        public $date_modified;
        public $image;     // boolean
        public $folder; // boolean

        function __construct($name) {
          $this->name = $name;
          $this->date_modified = filemtime($name);

          global $extensions;
          $extension = pathinfo($name, PATHINFO_EXTENSION);

          $this->image = in_array(strtoupper($extension), $extensions);

          $this->folder = is_dir($name);
        }

        function title() {
          global $convert_filenames;

          if ($convert_filenames) {
            return remove_gunk($this->name);
          } else {
            return $this->name;
          }
        }

        function folder_image() {
          return '
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 302 202">
              <g fill="none">
                <path d="M0 82.5L0 8C0 3.6 3.6 0 8 0L98 0C102.4 0 106 3.6 106 8L106 23 294 23C298.4 23 302 26.6 302 31L302 194C302 198.4 298.4 202 294 202L8 202C3.6 202 0 198.4 0 194L0 82.5Z" style="fill:#AAA"/>
              </g>
            </svg>';
        }

      }


      // setup

      if ($message != "") {
        echo "<p class='message'>", $message, "</p>";
      }

      $directory  = '.';

      $dir_scan = scandir($directory, 1);


      // convert all allowable extensions to uppercase

      foreach ($extensions as $key => $value) {
        $extensions[$key] = strtoupper($value);
      }


      // create object for each file

      foreach ($dir_scan as $key => $value) {
        $files[] = new directory_entry($value, $extensions);
      }

      // print_r($files);

      // this is experimental
      $show_folders = false;

      if ($show_folders) {
        foreach ($files as $file) {
          if (!$file->folder) continue;
          if ($file->name == "..") continue;
          if ($file->name == ".") continue;

          echo "<div class='folder'>\n  <a href='", $file->name, "'> ";

          echo $file->folder_image();

          // output title for main view
          if ($show_file_names) {
            echo "  <p class='caption'>".$file->title()."</p>\n";
          }
          echo "</a></div>\n\n";

        }

      }


      // loop through scanned files

      foreach ($files as $file) {
        if (!$file->image) continue;
        // if (!$file->image && !$file->folder) continue;
        // if ($file->folder && !$show_folders) continue;


        echo "<div class='border'>\n  <a href='", $file->name, "' data-lightbox='image' ";

        // output title for Lightbox2
        if ($show_file_names) {
          echo "title='".$file->title()."'";
        }

        echo ">\n    <img class='thumbnail' src='", $file->name, "' />\n  </a>\n";

        // output title for main view
        if ($show_file_names) {
          echo "  <p class='caption'>".$file->title()."</p>\n";
        }
        echo "</div>\n\n";
      }

    ?>

    <p class="credit"><strong>1-Step Gallery</strong> by <a href="http://alesh.com">Alesh Houdek</a>. Uses <a href="http://lokeshdhakar.com/projects/lightbox2/">Lightbox2</a>.</p>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox-plus-jquery.min.js"></script>

  <script>

    // on load, set maximum dize of images to window width
    $('#size-adjust').attr("max", $(window).width() - 40);

    // adjust image sizes
    $('#size-adjust').on("chnage mousemove", function() {
      $('.thumbnail').css("width", $(this).val());
      $('.caption').css("width", $(this).val());
      $('.folder a').css("width", $(this).val());
    });

    lightbox.option({
      'alwaysShowNavOnTouchDevices': true,
      'showImageNumberLabel': false,
      'fadeDuration': 100,
      'resizeDuration': 100
    })

  </script>

</body>
</html>