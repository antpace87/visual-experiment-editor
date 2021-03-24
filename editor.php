<?php $page_title = "A/B Test Idea Generator";?>
<?php $page_description = "The A/B Test Idea Generator gives you experiment ideas specific to your website. You can use our visual editor tool plan split tests.";?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/css/page-editor.php'; ?>
<?php
$url = "";
if(isset($_GET['url']) && strlen($_GET['url']) > 0){
  $url = $_GET['url'];
  $_SESSION['freeeditorurl'] = $url;
  include '/var/www/html/db-connection.php';
  $insertStatement = "INSERT INTO `freeeditor` (url) VALUES (:url)";
  $stmt = $conn->prepare($insertStatement); 
  $stmt->bindParam(':url', $url);
  $stmt->execute();

}
?>
<style>
  
  ul#breadcrumblist{
    display: none !important;
  }

</style>
<body class="">
   <!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>


    <div class="ap-container">
      
      <div class="loading-iframe" style="">

        <p>Loading<br /><i class="fas fa-spinner fa-spin"></i></p>
        <p style="margin:15px auto;display: block; font-size: 32px;">Split/Wit</p>


      </div>
      <div class="flex-container editor-container">
        <div class="left-side">
          <p style="font-size: 12px;">Use this tool to plan your A/B experiments.</p>
          <button type="button" class="btn emphasis feeling-lucky" style="width: 100%;margin: 10px auto;text-align: left;">Show me an A/B test idea! <i class="fas fa-glass-cheers" style="margin-top: 4px; float: right;"></i></button>
          
          
      
      
          <p class="cursor-pointer go-back-ahref"><span class="change-page-btn underline" style="color: #005b96;">Edit a different page</span> </p>
          
          <!-- Change page -->
          <div class="change-page-wrap toggable-section display-none" style="margin-bottom: 15px;">
            <p>Current page:</p>
            <input style="width: 100%;" type="url" name="current-page" id="change-editor-url" value="<?php echo $url; ?>">
            <br />
            <button class="btn change-editor-btn" style="margin-top: 15px;" type="button">Change editor page</button>
          </div>
          <!-- / Change page -->

        
          <div class="changes-list">


            <!-- insert html -->
            <button class="btn btn-default btn-block insert-html-btn" id="insert-html-btn">Insert content<i class="fab fa-html5"></i></button>

            <div class="insert-html-wrap toggable-section display-none">
              <p class="underline">Insert text, images, or HTML on to your website.</p>
              <p style="font-size: 12px">Click on an element in the editor to select where you want to insert new content.</p>
             
               
              <div class="">
                <label>Selector <i class="fas fa-question-circle selector-info"></i></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button class="btn find-selector" type="button">Find <i class="fas fa-check"></i></button>
                  </div>
                  <input class="form-control selector-input" /> 
                  <p class="width-100"><small class="multiple-elements display-none form-text text-muted"><span class="value"></span> matches found</small></p>
                </div>
                 <div style="display: flex;">
                  <p>Position:</p>
                  <select class="position-select" style="margin-left: 15px; height: 25px; font-size: 14px;">
                    <option value="before">Before</option>
                    <option value="after">After</option>
                    <!-- <option value="prepend">Prepend</option>
                    <option value="append">Append</option> -->
                  </select>
                </div>

                <div class="form-group">
                  <label><input value="html" type="radio" class="toggle-insert-type toggle-insert-html" checked name="insert-type"> HTML</label>
                  <textarea class="form-control insert-html-textarea"></textarea> 
                </div>
                
                <div class="form-group">
                  <hr />
                  <label class="image-label"><input value="image" class="toggle-insert-type toggle-insert-image" type="radio" name="insert-type"> Image</label>
                  <img src="" class="display-none image-preview" style="width:50px; margin: 10px;">
                  
                  <div class="display-none insert-image-div">
                    <input class="form-control img-url el-input" /> 
                   
                    <button style="margin-top: 8px;" class="btn upload-image" type="button">Upload image</button>
                  </div>
                  <hr />
                </div>


              </div>

              <p><button class="btn btn-default insert-html-save-btn">Save <i class="fas fa-save"></i></button></p>

            </div>

            <!-- / insert html -->

        

            <!-- make a change -->

            <button class="btn btn-default btn-block element-change-btn">Change content<i class="fas fa-exchange-alt"></i></button>
            <div class="element-change-wrap toggable-section display-none">
              <!-- selecting an element will automatically reveal this section -->
              <p class="underline" id="try-experimenting">Try experimenting with text or images!</p>
              <p style="font-size: 12px">Click on an element in the editor to select it. You can also manually enter a CSS selector.</p>
              <p><button class="btn btn-default element-change-save-btn" disabled>Save <i class="fas fa-save"></i></button></p>

              
              <div class="page-editor-info">
                <label id="change-selector-label">Selector <i class="fas fa-question-circle selector-info"></i></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button class="btn find-selector" type="button">Find <i class="fas fa-check"></i></button>
                  </div>
                  <input class="form-control selector-input" /> 
                  <p class="width-100"><small class="multiple-elements display-none form-text text-muted"><span class="value"></span> matches found</small></p>
                </div>

                <div class="form-group html-input-wrap display-none">
                  <label id="change-html-label"><i class="fas fa-dot-circle change-indicator display-none"></i> Text / HTML</label>
                  <textarea class="form-control html-input el-input"></textarea> 
                </div>
                <div class="form-group img-url-wrap display-none">
                  <hr />
                  <label class="image-label"><i class="fas fa-dot-circle change-indicator display-none"></i> Image</label>
                  <img src="" class="image-preview" style="width:50px; margin: 10px;">
                  <input class="form-control img-url el-input" /> 
                   
                  <button style="margin-top: 8px;" class="btn upload-image" type="button">Upload image</button>
                  
                  <hr />
                </div>
                <div class="form-group link-url-wrap display-none">
                  <label><i class="fas fa-dot-circle change-indicator display-none"></i> Link</label>
                  <input class="form-control link-url el-input" /> 
                </div>
              </div>
              <div class="element-border elem-css-group display-none">
                <i style="margin-right: 10px;" class="fas fa-dot-circle change-indicator display-none"></i>

                <div class="form-check form-check-inline">
                  <input class="form-check-input visibility-radio" type="radio" id="visible-radio" name="visibility" value="visible">
                  <label class="form-check-label" for="visible-radio">Visible</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input visibility-radio" type="radio" id="hidden-radio" name="visibility" value="hidden" >
                  <label class="form-check-label" for="hidden-radio">Hidden</label>
                </div>
              </div>
              <hr />
              
              <div class="form-group elem-css-group display-none">
                  <label id="border-label"><i class="fas fa-dot-circle change-indicator display-none"></i> Border</label>
                  <input class="form-control border el-input css-input" data-cssproperty="border" /> 
                  <p><small class="small-text view-options" data-cssproperty="border">View options</small></p>
              </div>
              
              <hr />
              <div class="form-group elem-css-group display-none">
                  <label id="bgcolor-label"><i class="fas fa-dot-circle change-indicator display-none"></i> Background color</label>
                  <input class="form-control background el-input css-input" data-cssproperty="background" /> 
                  <p><small class="small-text view-options" data-cssproperty="background">View options</small></p>
              </div>
              <hr />
              <div class="form-group elem-css-group display-none">
                  <label><i class="fas fa-dot-circle change-indicator display-none"></i> Animation</label>
                  <select id="animation-select">
                      <option value="none">none</option>
                      <option value="bounce">bounce</option>
                      <option value="flash">flash</option>
                      <option value="pulse">pulse</option>
                      <option value="rubberBand">rubberBand</option>
                      <option value="shake">shake</option>
                      <option value="swing">swing</option>
                      <option value="tada">tada</option>
                      <option value="wobble">wobble</option>
                      <option value="jello">jello</option>
                      <option value="heartBeat">heartBeat</option>
                      <option value="bounceIn">bounceIn</option>
                      <option value="bounceInDown">bounceInDown</option>
                      <option value="bounceInLeft">bounceInLeft</option>
                      <option value="bounceInRight">bounceInRight</option>
                      <option value="bounceInUp">bounceInUp</option>
                      <option value="bounceOut">bounceOut</option>
                      <option value="bounceOutDown">bounceOutDown</option>
                      <option value="bounceOutLeft">bounceOutLeft</option>
                      <option value="bounceOutRight">bounceOutRight</option>
                      <option value="bounceOutUp">bounceOutUp</option>
                      <option value="fadeIn">fadeIn</option>
                      <option value="fadeInDown">fadeInDown</option>
                      <option value="fadeInDownBig">fadeInDownBig</option>
                      <option value="fadeInLeft">fadeInLeft</option>
                      <option value="fadeInLeftBig">fadeInLeftBig</option>
                      <option value="fadeInRight">fadeInRight</option>
                      <option value="fadeInRightBig">fadeInRightBig</option>
                      <option value="fadeInUp">fadeInUp</option>
                      <option value="fadeInUpBig">fadeInUpBig</option>
                      <option value="fadeOut">fadeOut</option>
                      <option value="fadeOutDown">fadeOutDown</option>
                      <option value="fadeOutDownBig">fadeOutDownBig</option>
                      <option value="fadeOutLeft">fadeOutLeft</option>
                      <option value="fadeOutLeftBig">fadeOutLeftBig</option>
                      <option value="fadeOutRight">fadeOutRight</option>
                      <option value="fadeOutRightBig">fadeOutRightBig</option>
                      <option value="fadeOutUp">fadeOutUp</option>
                      <option value="fadeOutUpBig">fadeOutUpBig</option>
                      <option value="flip">flip</option>
                      <option value="flipInX">flipInX</option>
                      <option value="flipInY">flipInY</option>
                      <option value="flipOutX">flipOutX</option>
                      <option value="flipOutY">flipOutY</option>
                      <option value="lightSpeedIn">lightSpeedIn</option>
                      <option value="lightSpeedOut">lightSpeedOut</option>
                      <option value="rotateIn">rotateIn</option>
                      <option value="rotateInDownLeft">rotateInDownLeft</option>
                      <option value="rotateInDownRight">rotateInDownRight</option>
                      <option value="rotateInUpLeft">rotateInUpLeft</option>
                      <option value="rotateInUpRight">rotateInUpRight</option>
                      <option value="rotateOut">rotateOut</option>
                      <option value="rotateOutDownLeft">rotateOutDownLeft</option>
                      <option value="rotateOutDownRight">rotateOutDownRight</option>
                      <option value="rotateOutUpLeft">rotateOutUpLeft</option>
                      <option value="rotateOutUpRight">rotateOutUpRight</option>
                      <option value="slideInUp">slideInUp</option>
                      <option value="slideInDown">slideInDown</option>
                      <option value="slideInLeft">slideInLeft</option>
                      <option value="slideInRight">slideInRight</option>

                      <option value="slideOutUp">slideOutUp</option>
                      <option value="slideOutDown">slideOutDown</option>
                      <option value="slideOutLeft">slideOutLeft</option>
                      <option value="slideOutRight">slideOutRight</option>
                    
                      <option value="zoomIn">zoomIn</option>
                      <option value="zoomInDown">zoomInDown</option>
                      <option value="zoomInLeft">zoomInLeft</option>
                      <option value="zoomInRight">zoomInRight</option>
                      <option value="zoomInUp">zoomInUp</option>

                      <option value="zoomOut">zoomOut</option>
                      <option value="zoomOutDown">zoomOutDown</option>
                      <option value="zoomOutLeft">zoomOutLeft</option>
                      <option value="zoomOutRight">zoomOutRight</option>
                      <option value="zoomOutUp">zoomOutUp</option>
                   
                      <option value="hinge">hinge</option>
                      <option value="jackInTheBox">jackInTheBox</option>
                      <option value="rollIn">rollIn</option>
                      <option value="rollOut">rollOut</option>
                    
                  </select>

              </div>
              <hr />
              <button class="btn view-font-options" type="button">View font properties <i class="fas fa-font"></i></button>

              <div class="font-property-options display-none">
                <div class="form-group elem-css-group display-none">
                    <label id="font-family-label"><i class="fas fa-dot-circle change-indicator display-none"></i> Font family</label>
                    <input class="form-control font-family el-input css-input" data-cssproperty="font-family" /> 
                    <p><small class="small-text view-options" data-cssproperty="font-family">View options</small></p>
                </div>
                <div class="form-group elem-css-group display-none">
                    <label><i class="fas fa-dot-circle change-indicator display-none"></i> Font size</label>
                    <input class="form-control font-size el-input css-input" data-cssproperty="font-size" /> 
                </div>
                <div class="form-group elem-css-group display-none">
                    <label><i class="fas fa-dot-circle change-indicator display-none"></i> Font weight</label>
                    <input class="form-control font-weight el-input css-input" data-cssproperty="font-weight" /> 
                    <p><small class="small-text view-options" data-cssproperty="font-weight">View options</small></p>
                </div>
                <div class="form-group elem-css-group display-none">
                    <label><i class="fas fa-dot-circle change-indicator display-none"></i> Font style</label>
                    <input class="form-control font-style el-input css-input" data-cssproperty="font-style" /> 
                    <p><small class="small-text view-options" data-cssproperty="font-style">View options</small></p>
                </div>
                <div class="form-group elem-css-group display-none">
                    <label><i class="fas fa-dot-circle change-indicator display-none"></i> Text decoration</label>
                    <input class="form-control text-decoration el-input css-input" data-cssproperty="text-decoration" /> 
                    <p><small class="small-text view-options" data-cssproperty="text-decoration">View options</small></p>
                </div>
              </div>
              <hr />
              <button class="btn view-size-options" type="button">View size options <i class="far fa-window-maximize"></i></button>

              <div class="size-property-options display-none">
                <div class="form-group elem-css-group display-none">
                    <label><i class="fas fa-dot-circle change-indicator display-none"></i> Height</label>
                    <input class="form-control height el-input css-input" data-cssproperty="height" /> 
                </div>
                <div class="form-group elem-css-group display-none">
                    <label><i class="fas fa-dot-circle change-indicator display-none"></i> Width</label>
                    <input class="form-control width el-input css-input" data-cssproperty="width" /> 
                </div>
                <div class="form-group elem-css-group display-none">
                    <label><i class="fas fa-dot-circle change-indicator display-none"></i> Margin</label>
                    <input class="form-control margin el-input css-input" data-cssproperty="margin" /> 
                </div>
                <div class="form-group elem-css-group display-none">
                    <label><i class="fas fa-dot-circle change-indicator display-none"></i> Padding</label>
                    <input class="form-control padding el-input css-input" data-cssproperty="padding" /> 
                </div>
              </div>
              
              <hr />

              
              <div class="form-group elem-css-group display-none">
                <label><i class="fas fa-dot-circle change-indicator display-none"></i> Add CSS to this element</label>
                <input class="form-control inline-css-input css-input" data-cssproperty="css" /> 
              </div>
              <div class="form-group elem-css-group display-none">
                <label><i class="fas fa-dot-circle change-indicator display-none"></i> Add classes to this element</label>
                <input class="form-control classes-input css-input" data-cssproperty="classes" /> 
                

              </div>
            
              <div class="element-border elem-css-group display-none" style="overflow: auto;">          
                <label style="display: block;">Measure clicks on this element?</label>
                <i style="margin-right: 10px;" class="fas fa-dot-circle change-indicator display-none"></i>
                <div class="form-check form-check-inline">
                  <input class="form-check-input metric-radio" type="radio" id="measure-radio" name="metric" value="yes">
                  <label class="form-check-label" for="measure-radio">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input metric-radio" type="radio" id="dont-mesaure-radio" name="metric" checked="checked" value="no" >
                  <label class="form-check-label"  for="dont-mesaure-radio">No</label>
                </div>
                
              </div>
           
              <div>
                <button class="btn btn-default element-change-save-btn" disabled>Save <i class="fas fa-save"></i></button>
              </div>

            </div>  <!-- end element-change-wrap -->
            
            <button class="btn btn-default btn-block add-sticky-btn">Add a sticky bar <i class="fas fa-sticky-note"></i></button>
            <div class="add-sticky-wrap toggable-section display-none">
              <p style="font-size: 12px;">Use sticky bars to drive traffic to certain pages.</p>
              <form>
              <div><label>Position: </label></div>

              <div class="form-check form-check-inline">
                <input class="form-check-input sticky-position-radio" id="top-radio" type="radio" name="position" value="top">
                <label class="form-check-label" for="top-radio">Top</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input sticky-position-radio" id="bottom-radio" type="radio" checked name="position" value="bottom">
                <label class="form-check-label" for="bottom-radio">Bottom</label>
              </div>
              <div class="form-group" style="margin-top: 1em;">
                <label>Background color:</label>
                  <select name="background" class="sticky-background-option" style="width: 100%;">
                    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/css-color-options.php'; ?>
                  </select>
              </div>
              <div class="form-group">
                <label>Text color:</label>
                  <select name="color" class="sticky-textcolor-option" style="width: 100%;">
                    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/css-color-options.php'; ?>
                  </select>
              </div>
              <div class="form-group">
                <label>Text:</label>
                  <input class="form-control sticky-text" name="text"/> 
              </div>
              <div class="form-group">
                <label>Link URL:</label>
                  <input class="form-control sticky-url" name="linkurl"/> 
              </div>
              </form>
              
            </div> <!-- end add sticky wrap -->


            <button class="btn btn-default btn-block open-modal-btn">Add modal "pop up" <i class="far fa-window-restore"></i></i></button>
            <div class="add-modal-wrap toggable-section display-none">
              <form>
              <div class="form-group" style="margin-top: 1em;">
                <label>Background color:</label>
                  <select name="background" class="modal-background-option" style="width: 100%;">
                    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/css-color-options.php'; ?>
                  </select>
              </div>
              <div class="form-group">
                <label>Title text:</label>
                  <input class="form-control modal-title-text" name="modaltitletext"/> 
              </div>
              <div class="form-group">
                <label>Title text color:</label>
                  <select name="titlecolor" class="modal-titlecolor-option" style="width: 100%;">
                    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/css-color-options.php'; ?>
                  </select>
              </div>
              
              <div class="form-group">
                <label>Body text:</label>
                  <input class="form-control modal-body-text" name="modalbodytext"/> 
              </div>
              <div class="form-group">
                <label>Body text color:</label>
                  <select name="bodycolor" class="modal-bodycolor-option" style="width: 100%;">
                    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/css-color-options.php'; ?>
                  </select>
              </div>
              <div class="form-group">
                <label>Button text:</label>
                  <input class="form-control modal-button-text" name="modalbuttontext"/> 
              </div>
              <div class="form-group">
                <label>Button color:</label>
                  <select name="buttoncolor" class="modal-buttoncolor-option" style="width: 100%;">
                    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/css-color-options.php'; ?>
                  </select>
              </div>
              <div class="form-group">
                <label>Button URL:</label>
                  <input class="form-control modal-button-url" name="modalbuttonurl"/> 
              </div>
              
              <div class="form-group">
                <label>Timing (in seconds):</label>
                <p style="font-size: 12px;">How long before this modal should show?</p>
                  <input type="number" class="form-control modal-timing" name="modaltiming"/> 
              </div>
              </form>
              
               
            </div>  
            


 
            <button class="btn btn-default btn-block add-javascript-btn">Add JavaScript or CSS <i class="fab fa-js-square"></i></button>
            <div class="add-javascript-wrap toggable-section display-none">
              <p style="font-size: 12px">Add custom JS. jQuery is already included.</p>
              <textarea class="js-textarea"> </textarea>
              <div>
                <button class="btn btn-default js-save-btn">Apply <i class="fas fa-save"></i></button>
              </div>
              <hr />
              <p style="font-size: 12px">Add custom CSS styles.</p>
              <textarea class="css-textarea"></textarea>
                <button class="btn btn-default css-save-btn">Apply <i class="fas fa-save"></i></button>
               
            </div>
            
           
             
             <button style="width: 100%; background-color: #011f4b;" type="button" class="btn settings-btn project-list-button experiment-status">Start Experiment<i class="fas fa-play"></i></button>

            

            


          </div>
        </div>

        <div class="page-iframe-wrapper"></div>

      </div>
      
    </div> <!-- /container -->  
 
<?php if(strlen($url)==0){ ?>
 
  <div id="url-modal" class="modal url-modal dont-dismiss" style="display: block;padding-top: 20%;">

    <div class="modal-content">
      
      <p>Enter a URL to start planning an A/B test.</p>
      <input style="width: 100%;" type="url" id="start-url-input" placeholder="https://">
      <br />
      <button type="button" class="btn start-url">Start</button>
    </div>

  </div>  
<?php } ?>

<div id="idea-modal" class="modal idea-modal" style="display: none;">

  <div class="modal-content">
    <p>
      <button type="button" class="dismiss-modal close" >&times;</button>
    </p>
    <h2 class="idea-title"></h2>
    <p class="idea-message"></p>

    <button type="button" class="btn dismiss-modal">Got it!</button>

    

  </div>

</div>

<div id="regprompt-modal" class="modal regprompt-modal" style="display: none;">

  <div class="modal-content">
    <p>
      <button type="button" class="dismiss-modal close" >&times;</button>
    </p>
     <p>You'll need to create an account before you can use SplitWit to run A/B tests.</p>

    <a href="https://www.splitwit.com/index?loginview=1" target="_blank" ><button style="width: 100%;" type="button" class="btn dismiss-modal">Create account</button></a>

    

  </div>

</div>


<div id="image-gallery-modal" class="modal image-gallery-modal" style="display: none;">
  <div class="modal-content">
    <h3>Your image gallery</h3>
    <p><strong>Upload a new file:</strong></p>
    <p>You'll need to <a href="https://www.splitwit.com/index?loginview=1" target="_blank">register for an account</a> before you can upload images.</p>
    <div><hr /></div>
    <div class="image-gallery-content">
      <p><strong>Select existing file:</strong></p>
      
      <div class='image-data-wrap'>
        <p class='filename'>sample-1.jpg</p>
        <img style='width:50px;display:block;margin:10px;' src='https://www.splitwit.com/stock-images/sample-1.jpg' class='display-none'>
        <button type='button' class='btn select-image'>Select</button>
        <hr />
      </div>

      <div class='image-data-wrap'>
        <p class='filename'>sample-2.jpg</p>
        <img style='width:50px;display:block;margin:10px;' src='' class='display-none'>
        <button type='button' class='btn select-image'>Select</button> 
        <button type='button' class='btn preview-image'>Preview</button> 
        <hr />
      </div>

      
      <div class='image-data-wrap'>
        <p class='filename'>sample-3.jpg</p>
        <img style='width:50px;display:block;margin:10px;' src='' class='display-none'>
        <button type='button' class='btn select-image'>Select</button> 
        <button type='button' class='btn preview-image'>Preview</button> 
        <hr />
      </div>

      
      <div class='image-data-wrap'>
        <p class='filename'>sample-4.jpg</p>
        <img style='width:50px;display:block;margin:10px;' src='' class='display-none'>
        <button type='button' class='btn select-image'>Select</button> 
        <button type='button' class='btn preview-image'>Preview</button> 
        <hr />
      </div>

      
      <div class='image-data-wrap'>
        <p class='filename'>sample-5.jpg</p>
        <img style='width:50px;display:block;margin:10px;' src='' class='display-none'>
        <button type='button' class='btn select-image'>Select</button> 
        <button type='button' class='btn preview-image'>Preview</button> 
        <hr />
      </div>

      
      <div class='image-data-wrap'>
        <p class='filename'>sample-6.jpg</p>
        <img style='width:50px;display:block;margin:10px;' src='' class='display-none'>
        <button type='button' class='btn select-image'>Select</button> 
        <button type='button' class='btn preview-image'>Preview</button> 
        <hr />
      </div>

      
      <div class='image-data-wrap'>
        <p class='filename'>sample-7.jpg</p>
        <img style='width:50px;display:block;margin:10px;' src='' class='display-none'>
        <button type='button' class='btn select-image'>Select</button> 
        <button type='button' class='btn preview-image'>Preview</button> 
        <hr />
      </div>


    </div>
     
  </div>
</div>

<div id="view-options-modal" class="modal view-options-modal" style="display: none;">
  <div class="modal-content">
    <p>
      <button type="button" class="dismiss-modal close" >&times;</button>
    </p>
    <h2 class="css-property"></h2>
    
    <div class="css-options background-options">
      <div class="form-group">
        <select class="background-option" style="width: 100%;">
          <?php include  $_SERVER['DOCUMENT_ROOT'] . '/css-color-options.php'; ?>
         
        </select>
      </div>
    </div>
    <div class="css-options text-decoration-options">
      <div class="form-group">
        <select class="text-decoration-option" style="width: 100%;">
          <option>underline</option>
          <option>line-through</option>
          <option>overline</option>
        </select>
      </div>
    </div>
    <div class="css-options font-style-options">
      <div class="form-group">
        <select class="font-style-option" style="width: 100%;">
          <option>italic</option>
          <option>normal</option>
          <option>oblique</option>
        </select>
      </div>
    </div>
    <div class="css-options font-weight-options">
      <div class="form-group">
        <select class="font-weight-option" style="width: 100%;">
          <option>100</option>
          <option>200</option>
          <option>300</option>
          <option value="400">normal (400)</option>
          <option>500</option>
          <option>600</option>
          <option value="bold" selected>bold (700)</option>
          <option>800</option>
          <option>900</option>
        </select>
      </div>
    </div>
    <div class="css-options font-family-options">
      <div class="form-group">
        <select class="font-family-name" style="width: 100%;">
          <option>Arial, Helvetica, sans-serif</option>       
          <option>"Arial Black", Gadget, sans-serif</option>       
          <option>"Comic Sans MS", sans-serif, sans-serif</option>       
          <option>Impact, Charcoal, sans-serif</option>       
          <option>"Lucida Sans Unicode", "Lucida Grande", sans-serif</option>       
          <option>Tahoma, Geneva, sans-serif</option>       
          <option>"Trebuchet MS", Helvetica, sans-serif</option>       
          <option>Verdana, Geneva, sans-serif</option>       
          <option>"Courier New", Courier, monospace</option>           
          <option>"Lucida Console", Monaco, monospace</option>           
          <option>Georgia, serif</option>       
          <option>"Times New Roman", Times, serif</option>       
          <option>"Palatino Linotype", "Book Antiqua", Palatino, serif</option>       
        </select>
      </div>
    </div>
    
    <div class="css-options border-options">
       <div class="form-group">
        <label>Border size</label>
        <select class="border-size">
          <option>0px</option>
          <option selected>1px</option>
          <option>2px</option>
          <option>3px</option>
          <option>4px</option>
          <option>5px</option>
          <option>6px</option>
          <option>7px</option>
          <option>8px</option>
          <option>9px</option>
          <option>10px</option>
          <option>11px</option>
          <option>12px</option>
          <option>13px</option>
          <option>14px</option>
          <option>15px</option>
          <option>16px</option>
          <option>17px</option>
          <option>18px</option>
          <option>19px</option>
          <option>20px</option>
          <option>21px</option>
        </select>
      </div>
       <div class="form-group">
        <label>Border style</label>
        <select class="border-style">
          <option>dotted</option>
          <option>solid</option>
          <option>double</option>
          <option>dashed</option>
          <option>groove</option>
          <option>ridge</option>
          <option>inset</option>
          <option>outset</option>
          
        </select>
      </div>
       <div class="form-group">
        <label>Color</label>
        <select class="border-color">
          <?php include  $_SERVER['DOCUMENT_ROOT'] . '/css-color-options.php'; ?>
        </select>
      </div>
    </div>
    <button type="button" class="btn btn-default apply-css-options" data-cssproperty="">Apply</button>
  </div>

</div>
<div id="selector-modal" class="modal selector-modal" style="display: none;">

  <!-- Modal content -->
  <div class="modal-content">
    <p>
      <button type="button" class="dismiss-modal close" >&times;</button>
    </p>    
    <h3>Selectors</h3>
      
    <p>A CSS selector is a way of specifying a UI element on a website. It could be an HTML element, class, or ID.</p>
    <p>Elements are specified simply by there HTML name: “button”, “h1”, “div”, “a”</p>
    <p>Classes need to be prefaced by a dot: .my-class</p>
    <p>IDs are prefaced by a hashtag: #unique-id</p>
    <button class="btn dismiss-modal">Okay</button>

    </div>

</div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>

<script>
<?php 
$timestamp = time(); 
$sessid = md5($timestamp);

?>
$(document).ready(function(){

  $(".experiment-status").click(function(){
    $("#regprompt-modal").show();
  });

  $(".start-url").click(function(){
    var url = $("#start-url-input").val();
    if(url.length < 1){
      return window.inputError($("#start-url-input"), "Please use a valid URL.");
    }

    if(url.search(/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/) < 0){
      return window.inputError($("#start-url-input"), "Please use a valid URL.");
    }
    
    var pattern = /^((http|https):\/\/)/;
    if(!pattern.test(url)){
      url = "http://" + url;
    }

    $(this).attr("disabled", "disabled");

    window.location = window.location + "?url=" + url;

  });
  
  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;SameSite=None;Secure";
  }

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  if(getCookie("sessid").length === 0){
    setCookie("sessid", "<?php echo $sessid; ?>", 7);
  }

  
  function findSelector(testSelectorEl){
    //dig deeper down the dom
    var i = 8;
    while(i > 0){
      if ( $(testSelectorEl).children().length > 0 ) {
        nextEl = $(testSelectorEl).find(">:first-child");
        if(nextEl.is( "style" ) || nextEl.is( "script" ) || nextEl.is( "noscript" )){
           nextEl = $(testSelectorEl).find(">:nth-child(2)");
        }
        if ( !nextEl.is( "u" ) && !nextEl.is( "i" ) && !nextEl.is( "strong" ) && !nextEl.is( "em" )) {
          testSelectorEl = nextEl;
        }
      }
      i--;
    }

    var node = testSelectorEl;
    var path = "";
    while (node.length) {
        var realNode = node[0], name = realNode.localName;
        if (!name) break;
        name = name.toLowerCase();

        var parent = node.parent();

        var siblings = parent.children(name);
        if (siblings.length > 1) { 
            name += ':eq(' + siblings.index(realNode) + ')';
        }

        path = name + (path ? '>' + path : '');
        node = parent;
    }
    var value = path;
    
    
    $(".selector-input").val(value); 
    $(".find-selector").click();
    return value;
  }

  function checkIfIdeaElExists(element){
    var iFrameDOM = $("iframe#page-iframe").contents();
    var el = iFrameDOM.find(element);     
    var elementFound = false;
    for (i = 0; i < el.length; i++) {
      var thisEl = $(el[i]);
      var lengthCheckPassed = false;
      if(thisEl.text().length){
        lengthCheckPassed = true;
      }
      if(element === "img"){
        lengthCheckPassed = true;
      }

      if(thisEl.length && thisEl.is(":visible") && lengthCheckPassed){
        
        
        var selectorPath = findSelector(thisEl);
        var selectorPathElement = iFrameDOM.find(selectorPath);
        if(element !== "img"){
          if(!selectorPathElement.html() || !selectorPathElement.html().length > 0){
            continue;
          }
        }
        selectorPathElement[0].scrollIntoView({ block: 'center' });

        selectorPathElement.addClass("highlighted");
        setTimeout(function(){selectorPathElement.removeClass("highlighted");},3000);
        elementFound = true;
        break;
      }
    }

    return elementFound;
    
  }

  function generateAbIdeaPart1(){
    var n = 21;
    var x = Math.floor(Math.random() * n);      // returns a random integer from 0 to n;
    // x=16; //for debugging
    
    var ideaMessage = "";
    var ideaTitle = "";
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-modal").remove();
    iFrameDOM.find("body #splitwit-sticky").remove();
    $(".past-due-warning").hide();

    switch (x) {
      case 0:
        ideaTitle = "Change CTAs";
        ideaMessage = 'Compelling call-to-action text makes the difference. Examples:<br><ul><li>Change "Contact" to "Get in touch", "Send a note", "Reach out", or "Talk to us"</li><li>Change "Continue" to "Yes please", "View more", or "Next"</li><li> Change "Subscribe" to "Sign Up Now" or "Start at no cost"</li></ul> ';
        break;

      case 1:
        ideaTitle = "Button Text";
        ideaMessage = "Try changing button text. By experimenting with word choice, you can learn what CTA works best for your website. <a href='https://www.splitwit.com/blog/a-b-test-examples-for-text-and-copy/' target='_blank'>You can read our blog to see more specific ideas</a>.";
        if(checkIfIdeaElExists("button")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("input[type='submit']")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }
        break;
      
      case 2:
        
        ideaTitle = "Button Color";
        ideaMessage = "Colors can have profound psychological effects. Try changing the background-color of important buttons on your website to see if that leads to an increase in conversion rate.";
        if(checkIfIdeaElExists("button")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("input[type='submit']")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }
        break;

      case 3:
      //fix this nesting nightmare
        ideaTitle = "Headline Text";
        ideaMessage = "Catchy headlines are important for increasing conversion rates. There are many formulas for writing great headline copy. But, knowing what will work for your own audience always requires A/B testing. <a href='https://www.splitwit.com/blog/you-should-ab-test-headline-text/' target='_blank'>You can read our blog for more specific ideas</a>.";

        if(checkIfIdeaElExists("h1")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }

        if(checkIfIdeaElExists("h2")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }

        if(checkIfIdeaElExists("h3")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }

        break;

      case 4:
        ideaTitle = "Add a Modal";
        ideaMessage = "Modals can be used to drive traffic to a particular product or webpage. They appear as overlaid “pop-ups” that present important information.<br /><br />They can be used to let visitors know about special deals or sales that are happening on your ecommerce website. Experimenting with how well your site does with and without them is a great idea for an A/B test.";
        $(".open-modal-btn").click();
        break;

      case 5:
        ideaTitle = "Add a sticky bar";
        ideaMessage = "Sticky bars are a great way to let potential customers know about specials, sales, and discounts.<br /><br /> They are less intrusive than pop-up modal windows, and still provide vital messaging to your visitors.";
        $(".add-sticky-btn").click();
        break;
      
      case 6:
        ideaTitle = "Add an animation";
        ideaMessage = "Drawing attention to vital messages and call-to-actions prompts can help increase sales and conversions.<br /><br />You can try adding animations to buttons, text, or images on your website.";
        if(checkIfIdeaElExists("a")){
          document.getElementById('border-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h1")){
          document.getElementById('border-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("img")){
          document.getElementById('border-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("button")){
          document.getElementById('border-label').scrollIntoView();
          break;
        }

        if(checkIfIdeaElExists("p")){
          document.getElementById('border-label').scrollIntoView();
          break;
        }           
        break;
      
      case 7:
        ideaTitle = "Button size";
        ideaMessage = "Increase the font-size of your buttons, and add more padding. This can help illicit an immediate response from potential customers.";

        if(checkIfIdeaElExists("button")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("input[type='submit']")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }

        break;

      case 8:
        ideaTitle = "Hyperlinks";
        ideaMessage = "Change the size and color of your hyperlinks to make them standout.";

        if(checkIfIdeaElExists("a")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        } 
        
        break;

      case 9:
        ideaTitle = "Change images";
        ideaMessage = "Images on your ecommerce store have a huge impact on how customers behave. Try swapping one image for another.";

        if(checkIfIdeaElExists("img")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        } 
        
        break;

      case 10:
        ideaTitle = "Insert a new image";
        ideaMessage = "An attractive image can help increase conversion rates. Try adding a new image as an A/B experiment.";
        $(".insert-html-btn").click();
        $(".toggle-insert-image").click();
        document.getElementById('insert-html-btn').scrollIntoView();
        
        break;
      
      case 11:
        ideaTitle = "Hide an existing element";
        ideaMessage = "Sometimes, less is more. Try hiding an existing element to increase negative space and add emphasis to other parts of your webpage";
        if(checkIfIdeaElExists("h1")){
          document.getElementById('try-experimenting').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("img")){
          document.getElementById('try-experimenting').scrollIntoView();
          break;
        }
        
        $(".element-change-btn").click()
        document.getElementById('try-experimenting').scrollIntoView();
        break;

      case 12:
        ideaTitle = "Replace a static image with an animated GIF";
        ideaMessage = "Animated images are more engaging and provide visual stimulation. They can help create an emotional connection to your brand.";
        if(checkIfIdeaElExists("img")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        } 

        break;

      case 13:
        ideaTitle = "PRODUCT TITLES";
        ideaMessage = "Changing the title of your product can have a positive effect on how users feel and could lead to more sales. Try changing the wording of product titles by using synonyms and adjectives.";
        if(checkIfIdeaElExists("h1")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }

        if(checkIfIdeaElExists("h2")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }

        if(checkIfIdeaElExists("h3")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }
        break;

      case 14:
        ideaTitle = "PRODUCT IMAGE";
        ideaMessage = "Images can evoke positive responses from prospective customers. Online shoppers tend to be visual buyers. They make decisions by visualizing what they want. Experiment with different images of the same product to find out what gets the best reaction from your store visitors.";
        if(checkIfIdeaElExists("img")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }
        break;

      case 15:
        ideaTitle = "Product descriptions";
        ideaMessage = "Product descriptions are meant to be explanatory and highlight product value. A great description should do more than that. While it does provide important information, keep in mind that it is ultimately marketing copy. When writing descriptions, do your best to persuade and entice potential buyers. Experiment with word choice and layout. Add visual language (“This green hat is a perfect fit for sunny walks through the park“) and remove empty phrases (“This hat is great“).";
        if(checkIfIdeaElExists("p")){
          document.getElementById('change-selector-label').scrollIntoView();
          break;
        }
        break;

      case 16:
        ideaTitle = "FONT SIZE";
        ideaMessage = "Increasing the size of your website's text is a great idea for an A/B test.";
        if(checkIfIdeaElExists("p")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h1")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h2")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h3")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        break;


      case 17:
        ideaTitle = "Pricing Display";
        ideaMessage = "Hiding (or showing) pricing information on your landing page can influence user engagement and lead collection. Try experimenting with your strategy.";
        break;

      case 18:
        ideaTitle = "Navigation options";
        ideaMessage = "Once a user reaches a critical stage of your conversion funnel (such as checkout) it could be helpful to limit their navigation options. Distractions, like header or footer links, may lead to conversion abandonment. Try hiding non-essential features and see if you get a jump in sales.";
        break;


      case 19:
        ideaTitle = "Layout";
        ideaMessage = "The design and layout of your pages can affect sales and conversions. A/B testing the visual hierarchy of your website's elements can be a crucial step towards your business goals.";
        break;


      case 20:
        ideaTitle = "Typography";
        ideaMessage = "Experimenting with the font-family your website uses can have an impact on how users connect with your brand.";
        if(checkIfIdeaElExists("p")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h1")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h2")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h3")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        break;

      case 21:
        ideaTitle = "Font style";
        ideaMessage = "The way copy is presented is a good place to A/B test. Try making text bold, adding underlines, or using italics for emphasis. See what clicks best for your audience.";
        if(checkIfIdeaElExists("p")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h1")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h2")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        if(checkIfIdeaElExists("h3")){
          $(".view-font-options").click();
          document.getElementById('font-family-label').scrollIntoView();
          break;
        }
        break;
       
      
      default:

        break;

    }

    $(".idea-modal").show();
    $(".idea-message").html(ideaMessage);
    $(".idea-title").text(ideaTitle);
  }
  
  $(".feeling-lucky").click(function(){
    
    generateAbIdeaPart1();

  });

  
  $(".selector-info").click(function(){
    $("#selector-modal").show();
  });

  $(".toggle-insert-html").click(function(){
    $(".insert-image-div").hide();
    $(".insert-html-textarea").show();
  });
  $(".toggle-insert-image").click(function(){
    $(".insert-html-textarea").hide();
    $(".insert-image-div").show();

  });
  $(".view-font-options").click(function(){
    $(".font-property-options").show();
    $(this).hide();
  });
  $(".view-size-options").click(function(){
    $(".size-property-options").show();
    $(this).hide();
  });
 
       
  
  $(".apply-css-options").click(function(){
    var cssProperty = $(this).attr("data-cssproperty");
    // console.log(cssProperty);
    if(cssProperty == "border"){
      var rule = $(".border-size").val() + " " + $(".border-style").val() + " " + $(".border-color").val()
      $("input.border").val(rule).parent().find(".change-indicator").show();
    }
    if(cssProperty == "font-family"){
      var rule = $(".font-family-name").val()
      $("input.font-family").val(rule).parent().find(".change-indicator").show();
    }
    if(cssProperty == "font-weight"){
      var rule = $(".font-weight-option").val()
      $("input.font-weight").val(rule).parent().find(".change-indicator").show();
    }
    if(cssProperty == "font-style"){
      var rule = $(".font-style-option").val()
      $("input.font-style").val(rule).parent().find(".change-indicator").show();
    }
    if(cssProperty == "text-decoration"){
      var rule = $(".text-decoration-option").val()
      $("input.text-decoration").val(rule).parent().find(".change-indicator").show();
    }
    if(cssProperty == "background"){
      var rule = $(".background-option").val()
      $("input.background").val(rule).parent().find(".change-indicator").show();
    }

    $(".element-change-save-btn").removeAttr("disabled");
    $(".modal").hide();
    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find(selector).css(cssProperty, rule);
  });

  $(".view-options").click(function(){
    $(".view-options-modal").show();
    var cssProperty = $(this).attr("data-cssproperty");
    $("h2.css-property").text(cssProperty);
    $(".css-options").hide();
    $(".css-options." + cssProperty + "-options").show();
    $(".apply-css-options").attr("data-cssproperty", cssProperty);
  });

  $(".element-change-btn").click(function(){
    $(".toggable-section:not(.element-change-wrap)").hide();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find("body #splitwit-sticky").remove();
    iFrameDOM.find("body #splitwit-modal").remove();
    // $(".selector-input").val("");
    $(".element-change-wrap").toggle();
    $("input.img-url").val("");
    $(".img-url-wrap").hide();
    $(".past-due-warning").hide();
  });

  $(".insert-html-btn").click(function(){
    $(".toggable-section:not(.insert-html-wrap)").hide();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find("body #splitwit-sticky").remove();
    iFrameDOM.find("body #splitwit-modal").remove();
    $(".insert-html-wrap").toggle();
    $("input.img-url").val("");
    $(".img-url-wrap").hide();
    $(".past-due-warning").hide();
  });


  $(".change-page-btn").click(function(){
    $(".change-page-wrap").toggle();
  });
  $("#change-editor-url").keypress(function(e){
      if(e.which == 13) {
        $(".change-editor-btn").click();
      }
  })

  $(".change-editor-btn").click(function(){
    $(".loading-iframe").show();
    var newUrl = $("#change-editor-url").val();
    var newEditorUrl = "/iframe-internal.php?baseUrl="+newUrl+"&url="+newUrl
    $("#page-iframe").attr("src", newEditorUrl);
    $(".change-page-wrap").hide()
    animationScriptAdded = false;
    $(".toggable-section").hide();

    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find("body #splitwit-sticky").remove();
    iFrameDOM.find("body #splitwit-modal").remove();

  });

  $(".position-select").change(function(){
      var position = $(".position-select").val();
      var selector = $(".selector-input").val();
      var iFrameDOM = $("iframe#page-iframe").contents()
      var existingElement = iFrameDOM.find(".htmlInsertText");
      if(existingElement.length){
        if(position == "before"){
          iFrameDOM.find(selector).before(existingElement);
        }
        if(position == "after"){
          iFrameDOM.find(selector).after(existingElement);
        }
      }
  });

    

  
  
 
  $("#visible-radio").click(function(){
    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find(selector).show();
  });
  $("#hidden-radio").click(function(){
    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find(selector).hide();
  });
  $("#top-radio").click(function(){
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-sticky").css("bottom", "initial");
    iFrameDOM.find("body #splitwit-sticky").css("top", "0");
  });
  $("#bottom-radio").click(function(){
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-sticky").css("top", "initial");
    iFrameDOM.find("body #splitwit-sticky").css("bottom", "0");

  });
  $(".sticky-background-option").change(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-sticky").css("background-color", x);
  });

  $(".sticky-textcolor-option").change(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-sticky").css("color", x);
  });
  $(".sticky-text").keyup(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-sticky").text(x);
  });

  $(".modal-title-text").keyup(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-modal-headline").text(x);
  });
  $(".modal-body-text").keyup(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-modal-body").text(x);
  });
  $(".modal-button-text").keyup(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    if(x.length === 0){
      x = "Continue";
    }
    iFrameDOM.find("body #splitwit-modal-button").text(x);

  });

  $(".modal-background-option").change(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-modal .modal-content").css("background-color", x);
  });
  $(".modal-titlecolor-option").change(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-modal .modal-content #splitwit-modal-headline").css("color", x);
  });
  $(".modal-bodycolor-option").change(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-modal .modal-content #splitwit-modal-body").css("color", x);
  });
  $(".modal-buttoncolor-option").change(function(){
    var x = $(this).val()
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body #splitwit-modal .modal-content #splitwit-modal-button").css("background-color", x);
  });

  var alreadyHasModal = false;
  $(".open-modal-btn").click(function(){
    var iFrameDOM = $("iframe#page-iframe").contents();
    var modal = iFrameDOM.find("body #splitwit-modal");
    iFrameDOM.find("body #splitwit-sticky").remove();
    
    $(".toggable-section:not(.add-modal-wrap)").hide();
    $(".past-due-warning").hide();
    $(".add-modal-wrap").toggle();

    if($(".add-modal-wrap").is(":visible")){ 
      if(modal.length > 0){
        alreadyHasModal = true;
        $(".add-modal-wrap").html("It looks like you've already added a modal pop-up. <span style='cursor:pointer;' class='underline view-changes-btn'>You'll have to delete</span> it before you can add a new one.");
        return;
      }
      $(".modal-background-option").val("white");
      $(".modal-titlecolor-option").val("darkblue");
      $(".modal-bodycolor-option").val("darkgrey");
      $(".modal-buttoncolor-option").val("darkblue");
      $(".modal-title-text").val("");
      $(".modal-body-text").val("");
      $(".modal-button-text").val("");
      $(".modal-button-url").val("");
      var modalHtml = '<style>.splitwit-modal .dismiss-modal{float:right;background-color:white;} .splitwit-modal h3{margin-bottom:10px;} .splitwit-modal p{margin-bottom:10px;} .modal{right:0;bottom:0;position:fixed;z-index:102;padding-top:25%;left:unset;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,.65)}.modal-content{background-color:#fff;margin:auto;padding:32px 23px;width:400px;height:auto;overflow:visible}</style><div id="splitwit-modal" class="modal splitwit-modal" style=""><div class="modal-content"><p> <button type="button" class="dismiss-modal close" >&times;</button></p><h3 style="color:darkblue; margin-top:0px;" id="splitwit-modal-headline">Your Headline</h3><p style="color:darkgrey;" id="splitwit-modal-body">Use this space to prompt users to visit another page or take a specific action.</p> <a id="splitwit-modal-link" href="#"><button type="button" id="splitwit-modal-button" style="color:white;background-color:darkblue;padding:10px;border-radius:3px;text-align:center;width:100%;">Continue</button></a></div></div>';

      iFrameDOM.find("body").append(modalHtml);
    }else{
      if(!alreadyHasModal){
        iFrameDOM.find("body #splitwit-modal").remove();
      }
    }


  });



  var alreadyHasSticky = false;
  
  $(".add-sticky-btn").click(function(){
    
    var iFrameDOM = $("iframe#page-iframe").contents();
    var sticky = iFrameDOM.find("body #splitwit-sticky");
    iFrameDOM.find("body #splitwit-modal").remove();
    
    $(".toggable-section:not(.add-sticky-wrap)").hide();
    $(".add-sticky-wrap").toggle();
    $(".past-due-warning").hide();
          
    if($(".add-sticky-wrap").is(":visible")){ 
      if(sticky.length > 0){
        alreadyHasSticky = true;
        $(".add-sticky-wrap").html("It looks like you've already added a sticky bar. <span style='cursor:pointer;' class='underline view-changes-btn'>You'll have to delete</span> it before you can add a new one.");
        return;
      }
      $(".sticky-background-option").val("darkblue");
      $(".sticky-textcolor-option").val("white");
      $(".sticky-text").val("");
      $("#bottom-radio").click();
      var stickyHtml = "<div style='font-weight:bold;bottom:0;position:fixed;z-index:100000;left:0px;text-align:center;padding:8px 20px;width:100%;background:darkblue;color:white;' id='splitwit-sticky'><p style='margin:0px'>Your message here!</p></div>"

      iFrameDOM.find("body").append(stickyHtml);
    }else{
      if(!alreadyHasSticky){
        iFrameDOM.find("body #splitwit-sticky").remove();
      }
    }

  });


  $(".add-javascript-btn").click(function(){
    $(".toggable-section:not(.add-javascript-wrap)").hide();
    $(".add-javascript-wrap").toggle();

    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find("body #splitwit-sticky").remove();
    iFrameDOM.find("body #splitwit-modal").remove();

  });



  $(".insert-html-save-btn").click(function(){
    $("#regprompt-modal").show();
  });
  $(".element-change-save-btn").click(function(){
    $("#regprompt-modal").show();
  });

  $(".js-save-btn").click(function(){
    var js = $(".js-textarea").val()
    js = js.replace("<script>","");
    js = js.replace("<\/script>","");
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find("body").append("<script>" + js + "<\/script>");
    
  });

  $(".css-save-btn").click(function(){
    var css = $(".css-textarea").val()
    css = css.replace("<style>","");
    css = css.replace("<\/style>","");
    var iFrameDOM = $("iframe#page-iframe").contents();
    iFrameDOM.find(".splitwit-styles").remove()
    iFrameDOM.find("body").append("<style class='splitwit-styles'>"+css+"</style>");
  });

  

  
  
  
  var testSelectorEl;
  var testSelectorElPath = "";
  var testSelectorElHtml = "";
  var testSelectorElImage = "";
  var testSelectorElLink = "";
  var originalVisibilityState = "";
  var originalValues = [];
  originalValues['height'] = "";
  originalValues['width'] = "";
  originalValues['margin'] = "";
  originalValues['padding'] = "";
  originalValues['border'] = "";
  originalValues['font-family'] = "";
  originalValues['font-weight'] = "";
  originalValues['font-style']= "";
  originalValues['text-decoration'] = "";
  originalValues['background'] = "";
  originalValues['css'] = "";
  originalValues['classes'] = "";
  

  $(".insert-html-textarea").keyup(function(){
    var htmlInsertText = $(this).val();  

    var position = $(".position-select").val();
    htmlInsertText = htmlInsertText.replace(/'/g, "&apos;");
    //minify htmContent 
    htmlInsertText = htmlInsertText.replace(/(\r\n|\n|\r)/gm,""); //line breaks
    htmlInsertText = htmlInsertText.replace(/>\s</g,"><"); //space between html tags (with no content bewtween)
    htmlInsertText = "<div class='htmlInsertText'>" + htmlInsertText + "</div>";
    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find(".htmlInsertText").remove();

    if(position == "before"){
      iFrameDOM.find(selector).before(htmlInsertText);
    }
    if(position == "after"){
      iFrameDOM.find(selector).after(htmlInsertText);
    }
  

  });
  $(".html-input").keyup(function(){
    var value = $(this).val();  
    if (value !== testSelectorElHtml){
      $(this).parent().find(".change-indicator").show();
    }else{
      $(this).parent().find(".change-indicator").hide();
    }

    if($(".change-indicator").is(":visible")){
      $(".element-change-save-btn").removeAttr("disabled");
    }else{
      $(".element-change-save-btn").attr("disabled", "disabled");
    }

    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find(selector).html(value);
    
  });
  
  $("input.img-url").keyup(function(){
    var value = $(this).val();
    if (value !== testSelectorElImage){
      $(this).parent().find(".change-indicator").show();
    }else{
      $(this).parent().find(".change-indicator").hide();
    }

    if($(".change-indicator").is(":visible")){
      $(".element-change-save-btn").removeAttr("disabled");
    }else{
      $(".element-change-save-btn").attr("disabled", "disabled");
    }

    $(".image-preview").attr("src", value);
    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find(selector).attr("src", value).attr("srcset", "");
    
  });

 
  $("input.link-url").keyup(function(){
    var value = $(this).val();
    if (value !== testSelectorElLink){
      $(this).parent().find(".change-indicator").show();
    }else{
      $(this).parent().find(".change-indicator").hide();
    }

    if($(".change-indicator").is(":visible")){
      $(".element-change-save-btn").removeAttr("disabled");
    }else{
      $(".element-change-save-btn").attr("disabled", "disabled");
    }
  });

  $("input.css-input").keyup(function(){
    var value = $(this).val();
    var cssProperty = $(this).attr("data-cssproperty");

    if (value !== originalValues[cssProperty]){
      $(this).parent().find(".change-indicator").show();
    }else{
      $(this).parent().find(".change-indicator").hide();
    }

    if($(".change-indicator").is(":visible")){
      $(".element-change-save-btn").removeAttr("disabled");
    }else{
      $(".element-change-save-btn").attr("disabled", "disabled");
    }
    
    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find(selector).css(cssProperty, value);

  });

  var animationScriptAdded = false;
  var listOfAddedClasses = new Array();
  $("#animation-select").change(function(){
    var animation = $(this).val();
    if(animation !== "none"){
      $(this).parent().find(".change-indicator").show();
    }else{
      $(this).parent().find(".change-indicator").hide();
    }

    if($(".change-indicator").is(":visible")){
      $(".element-change-save-btn").removeAttr("disabled");
    }else{
      $(".element-change-save-btn").attr("disabled", "disabled");
    }
    
    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()
    var animationScript = '<script>var head=document.getElementsByTagName("head")[0],link=document.createElement("link");link.rel="stylesheet";link.type="text/css";link.href="https://www.splitwit.com/css/animate.min.css";link.media="all";head.appendChild(link);<\/script>';
    if(!animationScriptAdded){
      iFrameDOM.find("body").append(animationScript);
      animationScriptAdded = true;
    }

    
    for (i = 0; i < listOfAddedClasses.length; i++) {
      iFrameDOM.find(selector).removeClass(listOfAddedClasses[i]);
    }
    listOfAddedClasses.push(animation);
    iFrameDOM.find(selector).removeClass("animated");

    iFrameDOM.find(selector).addClass("animated " + animation);


  });

  $(".metric-radio").change(function(){
    var x = $(".metric-radio:checked").val();
    if(x == "yes"){
      $(this).parent().parent().find(".change-indicator").show();
    }else{
      $(this).parent().parent().find(".change-indicator").hide();
    }

    if($(".change-indicator").is(":visible")){
      $(".element-change-save-btn").removeAttr("disabled");
    }else{
      $(".element-change-save-btn").attr("disabled", "disabled");
    }

  });

  $("input.visibility-radio").change(function(){
    currentVisibilityState = $("input.visibility-radio[name='visibility']:checked").val();
    if (currentVisibilityState !== originalVisibilityState){
      $(this).parent().parent().find(".change-indicator").show();
    }else{
      $(this).parent().parent().find(".change-indicator").hide();
    }

    if($(".change-indicator").is(":visible")){
      $(".element-change-save-btn").removeAttr("disabled");
    }else{
      $(".element-change-save-btn").attr("disabled", "disabled");
    }

  });

  $(".selector-input").keyup(function(){
    var myThis = $(this);
    var parent = myThis.closest(".toggable-section");
    var value = myThis.val();
    if (value !== testSelectorElPath){
      parent.find(".find-selector").show();
      $(".el-input").attr("disabled", "disabled");
    }else{
      parent.find(".find-selector").hide();
      $(".el-input").removeAttr("disabled");
    }
  });

  $("input.selector-input").keypress(function(e) {
    var myThis = $(this);
    var parent = myThis.closest(".toggable-section");
    if(e.which == 13) {
      e.preventDefault();
      parent.find(".find-selector").click();
    }
  });
  

$(".select-image").click(function() {
    var parent = $(this).parent();
    var filename = parent.find(".filename").text();
    var newImageUrl = "https://www.splitwit.com/stock-images/" + filename;
    
    var selector = $(".selector-input").val();
    var iFrameDOM = $("iframe#page-iframe").contents()

    if($(".element-change-wrap").is(":visible")){
      $(".element-change-wrap input.img-url").val(newImageUrl);
      $(".element-change-wrap .image-preview").attr("src", newImageUrl).show();
      $(".image-label .change-indicator").show();
      iFrameDOM.find(selector).attr("src", newImageUrl).attr("srcset", "");
    }
    if($(".insert-html-wrap").is(":visible")){
      $(".insert-html-wrap input.img-url").val(newImageUrl);
      $(".insert-html-wrap .image-preview").attr("src", newImageUrl).show();
      var position = $(".position-select").val();
      var htmlInsertText = "<img style='display: block; margin: 10px auto;' class='htmlInsertText' src='"+newImageUrl+"'>";
      iFrameDOM.find(".htmlInsertText").remove();
      if(position == "before"){
        iFrameDOM.find(selector).before(htmlInsertText);
      }
      if(position == "after"){
        iFrameDOM.find(selector).after(htmlInsertText);
      }
    }

    $(".element-change-save-btn").removeAttr("disabled");
    $(".modal").hide();

});

$(".preview-image").click(function() {
    console.log("clicked")
    var parent = $(this).parent();
    var filename = parent.find(".filename").text();
    parent.find("img").attr("src", "https://www.splitwit.com/stock-images/" + filename).show();
});

$(".image-gallery-content").on("click", ".delete-image", function() {
    var parent = $(this).parent();
    var filename = parent.find(".filename").text();
    var currentImageUrl = $(".img-url").val();
    if(currentImageUrl == "https://www.splitwit.com/stock-images/" + filename){
      $(".img-url").val(testSelectorElImage);
      $(".image-preview").attr("src", testSelectorElImage);
      var selector = $(".selector-input").val();
      var iFrameDOM = $("iframe#page-iframe").contents()
      iFrameDOM.find(selector).attr("src", testSelectorElImage);
    }
    $.ajax({
      method:"POST",
      data: { 
        'filename': filename, 
      },
      url: "/s3-delete.php?filename="+filename,
      complete: function(response){
        parent.remove();
        if(!$(".image-data-wrap").length){
          $(".image-gallery-content").html("");
        }
      }
    })

}); 

$(".upload-image").click(function(){
  $("#image-gallery-modal").show();
});

function selectNewElement(value){
  
    testSelectorElPath = value;
    testSelectorEl = pageIframe.contents().find(value);
    $(".change-indicator").hide()
    $(".el-input").removeAttr("disabled");
    $(".element-change-save-btn").attr("disabled", "disabled");
    $(".find-selector").hide();
    $(".element-change-wrap .selector-input").val(testSelectorElPath);

    $(".toggable-section").hide();

    var iFrameDOM = $("iframe#page-iframe").contents()
    iFrameDOM.find("body #splitwit-sticky").remove();
    iFrameDOM.find("body #splitwit-modal").remove();

    $(".past-due-warning").hide();

    $(".element-change-wrap").show();
    $(".multiple-elements").hide();

    if(testSelectorEl.attr("src") && testSelectorEl.attr("src").length > 0){
      $(".img-url").val(testSelectorEl.attr("src"));
      $(".image-preview").attr("src", testSelectorEl.attr("src"));
      $(".img-url-wrap").show();
      testSelectorElImage = testSelectorEl.attr("src");
    }else{
      if(testSelectorEl.attr("srcset") && testSelectorEl.attr("srcset").length > 0){
        var srcset = testSelectorEl.attr("srcset");
        newSrc = srcset.split(" ");
        $(".img-url").val(newSrc[0]);
        $(".image-preview").attr("src", newSrc[0]);
        $(".img-url-wrap").show();
        testSelectorElImage = newSrc[0];
      }else{
        testSelectorElImage = "";
        $(".img-url").val("");
        $(".img-url-wrap").hide();
      }
         
      
    }
    if(testSelectorEl.attr("href") && testSelectorEl.attr("href").length > 0){

      //need to replace double slashes, but not for protocol
      var myHref = testSelectorEl.attr("data-href");
      var protocol = "";
      
      if(myHref.substring(0, 7) === "http://"){
        protocol = "http://";
      }

      if(myHref.substring(0, 8) === "https://"){
        protocol = "https://";
      }


      //bug fix for double slashes showing up in URL where they should be single.
      myHref = myHref.replace(protocol, ""); //remove protocol
      myHref = myHref.replace("//", "/"); //replace double slashes with single
      myHref = protocol + myHref; //put protocol back on              

      $(".link-url").val(myHref);
      $(".link-url-wrap").show();
      testSelectorElLink = myHref;
    }else{
      testSelectorElLink = "";
      $(".link-url").val("");
      $(".link-url-wrap").hide();
    }

    if(testSelectorEl.html() && testSelectorEl.html().length > 0){
      var htmlInput = testSelectorEl.html();
      htmlInput = htmlInput.trim();
      $(".html-input").val(htmlInput);
      $(".html-input-wrap").show();
      testSelectorElHtml = htmlInput;
    }else{
      testSelectorElHtml = "";
      $(".html-input").val("");
      $(".html-input-wrap").hide();
    }

    $(".elem-css-group").show();
    if(testSelectorEl.is(":visible")){
      originalVisibilityState = "visible";
      $("#visible-radio").attr("checked", "checked");
      $("#hidden-radio").removeAttr("checked");
    }else{
      originalVisibilityState = "hidden";
      $("#hidden-radio").attr("checked", "checked");
      $("#visible-radio").removeAttr("checked");
    }
    originalValues['height'] = testSelectorEl.css("height");
    $(".height").val(originalValues['height']);

    originalValues['width'] = testSelectorEl.css("width");
    $(".width").val(originalValues['width']);
    
    originalValues['margin'] = testSelectorEl.css("margin");
    $(".margin").val(originalValues['margin']);
    
    originalValues['padding'] = testSelectorEl.css("padding");
    $(".padding").val(originalValues['padding']);

    originalValues['border'] = testSelectorEl.css("border");
    $(".border").val(originalValues['border']);
    originalValues['font-family'] = testSelectorEl.css("font-family");
    $(".font-family").val(originalValues['font-family']);
    originalValues['font-size'] = testSelectorEl.css("font-size");
    $(".font-size").val(originalValues['font-size']);
    originalValues['font-weight'] = testSelectorEl.css("font-weight");
    $(".font-weight").val(originalValues['font-weight']);
    originalValues['font-style']= testSelectorEl.css("font-style");
    $(".font-style").val(originalValues['font-style'])
    originalValues['text-decoration'] = testSelectorEl.css("text-decoration")
    $(".text-decoration").val(originalValues['text-decoration'])
    originalValues['background'] = "";
    $(".background").val(originalValues['background'])

} //end selectNewElement()


$(".find-selector").click(function(){
    var myThis = $(this);
    var parent = myThis.closest(".toggable-section");
    var value = parent.find(".selector-input").val();
    if(value.length < 1){
      return inputError(parent.find(".selector-input"), "That can't be blank")
    }
    selectedElement = pageIframe.contents().find(value);
    // console.log(selectedElement)
    if(selectedElement.length < 1){
      return inputError(parent.find(".selector-input"), "Nothing found")
    }


    myThis.hide();

    //
    if(parent.hasClass("element-change-wrap")){
      selectNewElement(value);
    }
    //

    //subtext to note how many of this element has been found
    if(selectedElement.length > 1){
      $(".el-input").val("");
      parent.find(".multiple-elements").show();
      parent.find(".multiple-elements .value").text(selectedElement.length);
    }


});
  
function removeSubdirectoryFromUrlString(url, ssl){
  
  var ssl = ssl || false;
  if(url.indexOf("https://")){
    ssl = true;
  }

  url = url.replace("http://", "");
  url = url.replace("https://", "");
  var pathArray = url.split("/")
  url = pathArray[0];
  if(ssl){
    url = "https://" + url;
  }else{
    url = "http://" + url;
  }

  return url;
}

//editor iframe

//need to get base url of this php variable (strip off any subdirectory path and query params)
var url = "<?php echo $url; ?>";
var ssl = false;
var pageIframe;
 
if(url.length > 0){

  if(url.indexOf("https:") !== -1){
    ssl = true
  }
   
  var baseUrl = removeSubdirectoryFromUrlString(url, ssl);
  if(baseUrl.slice(-1) !== "/"){
    baseUrl = baseUrl + "/";
  }



  //layover
  var style = "<style>.highlighted{background-color:rgba(255, 0, 0, 0.5);} </style>";
    
  
  var newHtml = "";

  var pageIframe = $('<iframe id="page-iframe" style="" src="/iframe-internal.php?baseUrl='+baseUrl+'&url=<?php echo $url; ?>"></iframe>').appendTo(".page-iframe-wrapper");
     
  pageIframe.on('load', function(){

    pageIframe.contents().find("body").prepend(style);
       
    pageIframe.contents().find("body *").mouseenter(function(){

      $(this).addClass('highlighted'); 

      testSelectorEl = $(this);
        

    }).mouseout(function(){

      $(this).removeClass('highlighted');   

    }).click(function(e){
      // console.log("clicked")
      e.preventDefault();
      e.stopPropagation();
      //dig deeper down the dom
      var i = 8;
      while(i > 0){
        if ( $(testSelectorEl).children().length > 0 ) {
          nextEl = $(testSelectorEl).find(">:first-child");
          if(nextEl.is( "style" ) || nextEl.is( "script" ) || nextEl.is( "noscript" )){
             nextEl = $(testSelectorEl).find(">:nth-child(2)");
          }
          if ( !nextEl.is( "u" ) && !nextEl.is( "i" ) && !nextEl.is( "strong" ) && !nextEl.is( "em" )) {
            testSelectorEl = nextEl;
          }
        }
        i--;
      }
      
      var node = testSelectorEl;
      var path = "";
      while (node.length) {
          var realNode = node[0], name = realNode.localName;
          if (!name) break;
          name = name.toLowerCase();

          var parent = node.parent();

          var siblings = parent.children(name);
          if (siblings.length > 1) { 
              name += ':eq(' + siblings.index(realNode) + ')';
          }

          path = name + (path ? '>' + path : '');
          node = parent;
      }
      var value = path;
                
      $(".selector-input").val(value); //for html insert section (redundant for change element section)
      if(! $(".insert-html-wrap").is(':visible')){
        selectNewElement(value);
        //scroll user to selector input
        $(".page-editor-info").offset().top;
      }
      return false;
    });

      
   pageIframe.contents().find("img").each(function(){
      var src = $(this).attr("src");
      if(src && src.length > 0 && src.indexOf("//") == -1){  //if not absolute reference
        if(src.charAt(0) !== "/"){
          src = "/" + src;
        }
        $(this).attr("src", baseUrl + src);
      }
   });
     
   pageIframe.contents().find("script").each(function(){
      var src = $(this).attr("src");          
   });

   pageIframe.contents().find("a").each(function(){
      var href = $(this).attr("href");
      $(this).attr("href", "");
      $(this).attr("data-href", href);
   });

     

   pageIframe.contents().find("body").attr("style", "cursor: pointer !important");
    
   $(".loading-iframe").hide();

  }); //page-iframe load
   
}else{
  //no URL found
   $(".loading-iframe").hide();

}


});

</script>

       
</body>
</html>
