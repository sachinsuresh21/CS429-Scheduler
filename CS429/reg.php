<?php
    
    $lang = $_GET['lang'];     # prioritized
    if ($lang == "") {
        $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    }
    
    if ($lang == "zh-cn") {
        $lang_file = "index-zhs.php"; 
    }
    elseif ($lang == "zh-tw") {
        $lang_file = "index-zht.php";
    }
    else {
        $lang_file = "index-en.php";
    }
    include_once 'lang/' . $lang_file;
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <title><?php echo $_TITLE ?></title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no"/>
        
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
            
        <link rel="apple-touch-icon" href="img/touch-icon-iphone.png"/>
        <link rel="apple-touch-icon" sizes="72x72" href="img/touch-icon-ipad.png"/>
        <link rel="apple-touch-icon" sizes="114x114" href="img/touch-icon-iphone4.png"/>
                        
        <!-- 320x460 for iPhone 3GS -->
        <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and not (-webkit-min-device-pixel-ratio: 2)" href="img/startup-iphone.png"/>
        <!-- 640x920 for retina display -->
        <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="img/startup-iphone4.png"/>
        <!-- iPad Portrait 768x1004 -->
        <link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: portrait)" href="img/startup-iPad-portrait.png"/>
        <!-- iPad Landscape 1024x748 -->
        <link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: landscape)" href="img/startup-iPad-landscape.png"/>
                            
        <meta name="robots" content="index,follow"/>
        
        <meta name="keywords" content="Siri"/>
        <meta name="description" content="Napplec: Get My Session Data. Siri Session Platform."/>
        
        <link href="css/style.css" rel="stylesheet" media="screen" type="text/css" />

        <script src="javascript/functions.js" type="text/javascript"></script>
        <script type="text/javascript">
            if ('standalone' in navigator && !navigator.standalone && (/iphone|ipod|ipad/gi).test(navigator.platform) && (/Safari/i).test(navigator.appVersion)) {
                
                var addToHomeConfig = {
                    animationIn:'bubble',		// Animation In
                    animationOut:'drop',		// Animation Out
                    lifespan:6000,				// The popup lives 10 seconds
                    expire:20,					// The popup is shown only once every 2 minutes
                    touchIcon:true
                };
                
                document.write('<link rel="stylesheet" href="css/add2home.css">');
                document.write('<script type="application\/javascript" src="javascript/add2home.js" charset="utf-8"><\/s' + 'cript>');
            }
        </script>
        
    </head>
    
    <body>
        
        <div id="topbar" class="black">
            <div id="title">
                <?php //echo $_TOP_BAR ?>codename Scheduler
            </div>
            <div id="leftbutton">
            </div>
        </div>
        
        <div id="content">
            <span class="graytitle"><?php //echo $_HEADER_0 ?>Please enter login information</span>
            
            <form method="post" action="reg-post.php">
                <fieldset>
                    <ul class="pageitem">
                        <li class="smallfield">
                            <span class="name" style="text-align:center!important; width:38%;"><?php //echo $_ENTER_CODE ?>Username:</span>
                            <input placeholder="<?php //echo $_INPUT_HINT ?>4~12 Characters" name="username" type="text" autocapitalize="off" autocomplete="off" autocorrect="off" style="width:60%"/>
                        </li>
                    </ul>
                    <ul class="pageitem">
                        <li class="smallfield">
                            <span class="name" style="text-align:center!important; width:38%;">Password:</span>
                            <input placeholder="<?php //echo $_INPUT_HINT ?>Case Sensitve" name="password" type="password" autocapitalize="off" autocomplete="off" autocorrect="off" style="width:60%"/>
                        </li>
                    </ul>
                    <ul class="pageitem">
                        <li class="smallfield">
                            <span class="name" style="text-align:center!important; width:38%;">First Name:</span>
                            <input placeholder="<?php //echo $_INPUT_HINT ?>" name="firstname" type="text" autocapitalize="off" autocomplete="off" autocorrect="off" style="width:60%"/>
                        </li>
                    </ul>
                    <ul class="pageitem">
                        <li class="smallfield">
                            <span class="name" style="text-align:center!important; width:38%;">Last Name:</span>
                            <input placeholder="<?php //echo $_INPUT_HINT ?>" name="lastname" type="text" autocapitalize="off" autocomplete="off" autocorrect="off" style="width:60%"/>
                        </li>
                    </ul>
                    <ul class="pageitem">
                        <li class="smallfield">
                            <span class="name" style="text-align:center!important; width:38%;">Email:</span>
                            <input placeholder="<?php //echo $_INPUT_HINT ?>hello@world.com" name="email" type="email" autocapitalize="off" autocomplete="off" autocorrect="off" style="width:60%"/>
                        </li>
                    </ul>
                    <ul class="pageitem">
                        <li class="smallfield">
                            <span class="name" style="text-align:center!important; width:38%;">CompanyID:</span>
                            <input placeholder="<?php //echo $_INPUT_HINT ?>Optional" name="companyId" type="text" autocapitalize="off" autocomplete="off" autocorrect="off" style="width:60%"/>
                        </li>
                    </ul>
                    <ul class="pageitem">
                        <li class="button">
                            <input type="submit" value="<?php //echo $_BUTTON ?>Submit" />
                        </li>
                    </ul>
                </fieldset>
                
            </form>
            <span style="padding:10px">
                <?php
                    if ($lang == "zh-cn" OR $lang == "zh-tw") {
                        echo "
                        <a href='index.php?lang=en-us'>English</a>
                        中文
                        <a href=#>Français</a>
                        ";
                    }
                    else {
                        echo "
                        English
                        <a href='index.php?lang=zh-cn'>中文</a>
                        <a href=#>Français</a>
                        ";
                    }
                ?>
            </span>
            
        </div>
    </body>
</html>