<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<?php include('du.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>On-page Analytics</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<div id="container">
<div class="header">
<div class="top-head">
    <div class="top-left"><div class="logo"><a href="index">On-page Analytics</a></div></div>
<div class="top-right">
<div id="reg"><a href="Logout">Logout</a></div>
</div>
</div>
</div>
<div class="wrap">
<div class="details">
	<div class="sidebar">
        <li><a href="welcome">Home</a></li>
        <li><a id="sidebaractive" href="analyse" type='active'>Analyse SEO</a></li>
        <li><a href="support">Support</a></li>
    </div>
    <div class="content">
<h2>Analyse On-Page SEO</h2>
<span>Analyse &amp; auditor each page's SEO of <?php echo $url ?> by typing the page's url and clicking on "Analyse SEO" button.</span>
<form action="" align="center" method="POST">
<p><b><i><?php echo $url ?></i></b>/ <input type="text" name="page" class="urlpage" value="Type your webpage url..."  onfocus="this.value = this.value=='Type your webpage url...'?'':this.value;" onblur="this.value = this.value==''?'Type your webpage url...':this.value;"> <input type="text" class="keypage" name="keyword" value="Type your keyword..."  onfocus="this.value = this.value=='Type your keyword...'?'':this.value;" onblur="this.value = this.value==''?'Type your keyword...':this.value;"> <input type="submit" name="analyse" value="Analyse SEO" class="button"></p>
</form>
<?php
$page = "";
$keyword = "";
$webpage = "";
$htmlfile = "";
$webfile = "";
$errors = array();
if (isset($_POST['analyse'])) {
  $page = mysqli_real_escape_string($db, $_POST['page']);
  $keyword = mysqli_real_escape_string($db, $_POST['keyword']);
  if ($page == "Type your webpage url..." || empty($page)) { array_push($errors,  "<b>* Webpage URL is required</b>"); }
  if ($keyword == "Type your keyword..." || empty($keyword)) { array_push($errors, "<b>* Keyword is required</b>"); }
  if (preg_match('/\s/',$page) ) {array_push($errors, "<b>* Ensure that the value entered is a webpage url</b>");}
  $webpage = $url . '/' .$page;
  include('errors.php');
  if (count($errors) == 0) {
  echo $webpage;
  $htmlfile = file_get_contents('http://'.$webpage);
  $webfile = $website . '.html';
  file_put_contents("websites/" .$webfile, $htmlfile);
  $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
  $DOCUMENT_ROOT .=  "/seo/websites/";
  $file = $DOCUMENT_ROOT . ''. $webfile;          //Root address of the source code

$filepointer = fopen($file, "r");           //File pointer for the files

$keyword="HTML";                        //Target Keyword 
$metadescription="";                  //Meta Description 
$metakeywordarray=array();

$URL="https://google.com/HTML-HTML-HTML_HTML/seo-analyser.php";
$urlkeywordcount;                   //count of keywords in URL
$urllength;                       //URL length


$countofkey=0;                      //Total count of key except in h1,h2 & title
$countofh1=0;                     //Count of h1 
$countofh2=0;                     //Count of h2
$countofh3=0;                     //Count of h3


$contentnumberofwords=0;          //Count of words in Content (total)
$countofkeyincontentbeforehundred=0;    //Count of Key in content before hundred
$totalcountofkeysincontent=0;       //Total count of keys in content
$wordsinparalessthanhundredflag=0;      //Flag used to detect hundred words in content 
$keyworddensity=0;              //Keyword Density  
$countofkeyinboldincontent=0;       //Count of keyword in bold in content
$countofkeyinitalicsincontent=0;      //Count of keyword in italics in content
$countofkeyinunderlineincontent=0;      //Count of keyword in underline in content
$countofkeyinlinktext=0;          //Count of keyword in link text (used as flag)
$countofsitemaphtml=0;            //Count of sitemap.html in link (used as flag)
$countofsitemapxml=0;           //Count of sitemap.xml in link (used as flag)

$countoferror=0;              //Count of Error throughout the file
$countofwarning=0;              //Count of Warning throughout the file
$countofoptimised=0;            //Count of Optimised throughout the file


rewind($filepointer);    //rewinding filepointer to the starting point

//selecting Meta description
while(!feof($filepointer))
{
  $line= fgets($filepointer);

  if(stripos($line, 'name="description"') !== false || stripos($line, "og:description") !== false || stripos($line, "twitter:description") !== false)
  {

    $first = stripos($line , "content=")+9;
    $second = strlen($line);
    $string = substr($line, $first, $second);
    $array=explode('"',$string);
    $GLOBALS['metadescription']=$array[0];
    echo "<br> Count = " .strlen($GLOBALS['metadescription']);

    if(strlen($GLOBALS['metadescription'])>160)
    {
      echo "<br> Warning : Description contains more than 160 characters";
      $GLOBALS['countofwarning']++;
    }
    else if(strlen($GLOBALS['metadescription'])<160)
    {
      echo "<br> Optimised : Description contains less than 160 characters";
      $GLOBALS['countofoptimised']++;
    }

    $x=stripos(strtolower($GLOBALS['metadescription']) , strtolower($GLOBALS['keyword']));
    if($x==NULL)
    {
      echo "<br> Warning : Meta Description doesnt contain keyword";
      $GLOBALS['countofwarning']++;
    }
    else
    {
      echo "<br> Optimised : Meta Description contains keyword";
      $GLOBALS['countofoptimised']++;
    }
  }

  if(stripos($line,"</head>") !== false)
  {
    break;
  } 
}
if(strlen($GLOBALS['metadescription'])==0 || strlen($GLOBALS['metadescription'])==NULL)       //If no meta description found
  {
    echo "<br> Error : Description not found";
    $GLOBALS['countoferror']++;
  }



    //Checking the URL  
    $urlkeywordcount = substr_count(strtolower($URL),strtolower($keyword));
    echo "<br><br> URL contains the keyword ".$urlkeywordcount. " times";

    if(stripos($URL,'_')!==false)
    {
      echo "<br><br> Warning : URL contains underscores. Try to eliminate them ";
      $GLOBALS['countofwarning']++;
    }
    else
    {
      echo "<br> Optimised : URL doesn't contain underscores ";
      $GLOBALS['countofoptimised']++;
    }

    $urllength = strlen($URL);
    echo "<br><br> url length : ".$urllength. " <br>";

    if($urllength>3 && $urllength<30)
    {
      echo "<br> Optimised : Your URL is SEO friendly";
      $GLOBALS['countofoptimised']++;
    }
    else if($urllength>30 && $urllength<70)
    {
      echo "<br> Warning : You can improve your URL length";
      $GLOBALS['countofwarning']++;
    }
    else if($urllength>70)
    {
      echo "<br> Error : Your URL is too big";
      $GLOBALS['countoferror']++;
    }


//Counting the number of times the keyword comes in tags except h1 , h2, title
function countkey($string)
{
  $GLOBALS['countofkey']=$GLOBALS['countofkey']+substr_count(strtolower($string),strtolower($GLOBALS['keyword']));
}

rewind($filepointer);    //rewinding filepointer to the starting point

//Selecting line by line from sourcecode and checking the tags 
while(!feof($filepointer))
{
  $line= fgets($filepointer);

  //for checking sitemap.html and .xml
  if(stripos($line, "<a ") !== false)
  {
    $second=0;
    for($i=0; $i<str_word_count($line); $i++)
    {
      $start = stripos($line, "<a" ,$second) +3;
      $first = stripos($line, ">", $start ) +1;
      $stringtocheckforsitemap = substr($line, $start, $first);
      $GLOBALS['countofsitemaphtml'] = substr_count(strtolower($stringtocheckforsitemap), "sitemap.html" );
      $GLOBALS['countofsitemapxml'] = substr_count(strtolower($stringtocheckforsitemap), "sitemap.xml" ) ;
    }
  }

  //Counting the characters in h1 
  if(stripos($line, "<h1>") !== false)
    {
      $first = stripos($line , "<h1>") + 4;
      $second = stripos($line, "</h1>", $first);
      $a = substr($line, $first, $second);
      $string = strip_tags($a);
      echo "<br> Count = " .strlen($string);
      echo "<br>";
      $GLOBALS['countofh1']++;
    }

  //Counting the characters in h2 
  if(stripos($line, "<h2>") !== false)
    {
      $first = stripos($line , "<h2>") + 4;
      $second = stripos($line, "</h2>", $first);
      $a = substr($line, $first, $second);
      $string = strip_tags($a);
      echo " Count = " .strlen($string);
      $GLOBALS['countofh2']++;
    }

  // Counting the characters in h3
  if(stripos($line, "<h3>") !== false)
    {
      $first = stripos($line , "<h3>") + 4;
      $second = stripos($line, "</h3>", $first);
      $a = substr($line, $first, $second);
      $string = strip_tags($a);
      echo " Count = " .strlen($string);  
      countkey($string);                //adding the number of keys in h3 to the total count of keys
      $GLOBALS['countofh3']++;
    }


// checking the whether img tags has alternate texts
  if(stripos($line, "<img") !== false)
    {
      $first = stripos($line , "<img")+1;
      $second = stripos($line, ">", $first);
      $string = substr($line, $first, $second);

      //image file name   
      $first = stripos($string , "name=")+6;
      $second = strlen($string);
      $nme = substr($string, $first, $second);
      $array=explode('"',$nme);
      $nme=$array[0];
      echo "<br> Count = " .strlen($nme);
      $keycount=substr_count(strtolower($nme),strtolower($GLOBALS['keyword']));
      if($keycount==0)
      {
        echo "<br> Warning : Image name doesn't contain the keyword";
        $GLOBALS['countofwarning']++;
      }
      else 
      {
        echo "<br> Optimised : Image name contains the keyword";
        $GLOBALS['countofoptimised']++;
      }

      if(strpos($nme,'_') !=0)
      {
        echo "<br> Warning : Image name contains underscores";
        $GLOBALS['countofwarning']++;
      }
      else
      {
        echo "<br> Optimised : Image name doesn't contains underscores";
        $GLOBALS['countofoptimised']++;
      }
        
      //image alternative text  
      if(stripos($string,"alt"))
      {
        $first = stripos($string , "alt=")+5;
        $second = strlen($string);
        $alt = substr($string, $first, $second);
        $array=explode('"',$alt);
        $alt=$array[0];
        echo "<br> Count = " .strlen($alt);
        countkey($alt);               //adding the number of keys in img alt to the total count of keys
        $keycount=substr_count(strtolower($alt),strtolower($GLOBALS['keyword']));
        if($keycount==0)
        {
          echo "<br> Warning : Alternate text doesn't contain the keyword ";
          $GLOBALS['countofwarning']++;
        }
        else
        {
          echo "<br> Optimised : Alternate text contains the keyword ";
          $GLOBALS['countofoptimised']++;
        }

      }
      else
      {
        echo "<br><br> Error : Image doesnt contain alternative text";
        $GLOBALS['countoferror']++;
        echo "<br> Warning : Alternate text doesn't contain the keyword ";
        $GLOBALS['countofwarning']++;
      }
    }

//Counting the character in paragraphs
  if(stripos($line, "<p>") !== false)
    {
      $first = stripos($line , "<p>") + 3;
      $second = stripos($line, "</p>", $first);
      $a = substr($line, $first, $second);
      $string = strip_tags($a);
      echo "<br> Count of characters = " .strlen($string);
      echo "<br>";

      countkey($string);    //adding the number of keys in content to the total count of keys

      //checking for bold keywords
      if(strpos($string, "<b>" ) !== false)
      {
        for($i=0; $i<str_word_count($string); $i++)
        {
          $first = strpos($string, "<b>" ) +3;
          $second = strpos($string, "</b>",$first);
          $boldstring = substr($string, $first, $second );
          $GLOBALS['countofkeyinboldincontent']=$GLOBALS['countofkeyinboldincontent']+substr_count(strtolower($boldstring),strtolower($GLOBALS['keyword']) );
        }
      }

      //checking for italics keywords
      if(strpos($string, "<i>" ) !== false)
      {
        for($i=0; $i<str_word_count($string); $i++)
        {
          $first = strpos($string, "<i>" ) +3;
          $second = strpos($string, "</i>",$first);
          $italicsstring = substr($string, $first, $second );
          $GLOBALS['countofkeyinitalicsincontent']=$GLOBALS['countofkeyinitalicsincontent']+substr_count(strtolower($italicsstring),strtolower($GLOBALS['keyword']) );
        }
      }

      //checking for underlined keywords
      if(strpos($string, "<u>" ) !== false)
      {
        for($i=0; $i<str_word_count($string); $i++)
        {
          $first = strpos($string, "<u>" ) +3;
          $second = strpos($string, "</u>",$first);
          $underlinedstring = substr($string, $first, $second );
          $GLOBALS['countofkeyinunderlineincontent']=$GLOBALS['countofkeyinunderlineincontent']+substr_count(strtolower($underlinedstring),strtolower($GLOBALS['keyword'] ));
        }
      }

      //checking for keywords in Hyperlinks
      if(strpos($string, "<a " ) !== false)
      { 
        $second=0;
        for($i=0; $i<str_word_count($string); $i++)
        {
          $start = strpos($string, "<a" ,$second) +3;
          $first = strpos($string, ">", $start ) +1;
          $second = strpos($string, "</u>",$first);
          $linktextstring = substr($string, $first, $second );
          $GLOBALS['countofkeyinlinktext'] = substr_count(strtolower($linktextstring),strtolower($GLOBALS['keyword']));
          $second = $second+4;
        }
      }
      
      $GLOBALS['totalcountofkeysincontent']=$GLOBALS['totalcountofkeysincontent'] + substr_count(strtolower($string), strtolower($GLOBALS['keyword']));
      $GLOBALS['contentnumberofwords']=$GLOBALS['contentnumberofwords']+str_word_count($string);

      if($GLOBALS['wordsinparalessthanhundredflag']==0)
      {
        if($GLOBALS['contentnumberofwords']<100)
        {
          $GLOBALS['countofkeyincontentbeforehundred'] = $GLOBALS['countofkeyincontentbeforehundred'] + substr_count(strtolower($string),strtolower($GLOBALS['keyword']));
        }

        if($GLOBALS['contentnumberofwords']>100)
        {
          $GLOBALS['wordsinparalessthanhundredflag']=1;
        }
      }
      countkey($string);
    }

// Counting the character in Title
  if(stripos($line, "<title>") !== false)
    {
      $first = stripos($line , "<title>") + 7;
      $second = stripos($line, "</title>", $first);
      $a = substr($line, $first, $second);
      $string = strip_tags($a);
      echo "<br> Count = " .strlen($string);

      if(strlen($string)>70)
      {
        echo "<br> Warning : Title is too long";
        $GLOBALS['countofwarning'];
      }
      else if(strlen($string)<70)
      {
        echo "<br> Optimised : Title is optimised";
        $GLOBALS['countofoptimised'];
      }
        
      $keywordcount = substr_count(strtolower($string),strtolower($GLOBALS['keyword']));

      if($keywordcount!=0)
        { echo "<br> Targeted Keyword found on Title ";
          if(stripos($string, $GLOBALS['keyword'])==0)
          {
            echo "<br> Optimised : Keyword found as the first word in title ";
            $GLOBALS['countofoptimised']++;
          }
          else
          {
            echo "<br> Targeted keyword not the first word in title ";
            $GLOBALS['countofwarning'];
          }
        }
        else
        {
          echo "<br> Targeted keyword not found in title";
          $GLOBALS['countofwarning'];
          echo "<br> Targeted keyword not the first word in title ";
          $GLOBALS['countofwarning'];
        }

    }
  }

//Checking the
if($countofh1 == 0)
{
  echo "<br> Error : No H1 tags found";
  $GLOBALS['countoferror']++;
}
else
{
  echo "<br> Optimised : H1 tags found";
  $GLOBALS['countofoptimised']++;
}

if($countofh2 == 0)
{
  echo "<br> Error : No H2 tags found";
  $GLOBALS['countoferror']++;
}
else
{
  echo "<br> Optimised : H2 tags found";
  $GLOBALS['countofoptimised']++;
}

if($countofh3 == 0)
{
  echo "<br> Warning : No H3 tags found";
  $GLOBALS['countofwarning']++;
}
else
{
  echo "<br> Optimised : No H3 tags found";
  $GLOBALS['countofoptimised']++;
}


if($countofkeyincontentbeforehundred == 0)
{
  echo "<br> Warning : No keyword before 100 words in the content ";
  $GLOBALS['countofwarning']++;
}
else
{
  echo "<br> Optimised : Keyword found before 100 words in the content ";
  $GLOBALS['countofoptimised']++;
}

echo "<br> Total document contain the keywords ".$countofkey. " times (excluding from h1,h2,title)";

if($contentnumberofwords < 1800)
{
  echo "<br> Warning : Improve your content words to 1800+ words ";
  $GLOBALS['countofwarning']++;
}
else if($contentnumberofwords > 1800)
{
  echo "<br> Optimised : Your content is of good length ";
  $GLOBALS['countofoptimised']++;
}

$keyworddensity = $totalcountofkeysincontent / $contentnumberofwords * 100;       //Calculating keyword density

if($keyworddensity>1 && $keyworddensity<8)
{
  echo "<br> Optimised : Optimum use of keywords ";
  $GLOBALS['countofoptimised'];
}
else if($keyworddensity < 1)
{
  echo "<br> Warning : Less use of keywords. Improve usage of keywords ";
  $GLOBALS['countofwarning']++;
}
else if($keyworddensity > 8)
{
  echo "<br> Error : Too many keywords ";
  $GLOBALS['countoferror']++;
}



if($countofkeyinboldincontent == 0)
{
  echo "<br> Warning : No keywords in bold";
  $GLOBALS['countofwarning']++;
}
else
{
  echo "<br> Optimised : Content includes keywords in bold";
  $GLOBALS['countofoptimised']++;
}

if($countofkeyinitalicsincontent == 0)
{
  echo "<br> Warning : No keyword in italics"; 
  $GLOBALS['countofwarning']++;
}
else
{
  echo "<br> Optimised : Content includes keywords in italics"; 
  $GLOBALS['countofoptimised']++;
}

if($countofkeyinunderlineincontent == 0)
{
  echo "<br> Warning : No keyword in underline"; 
  $GLOBALS['countofwarning']++;
}
else
{
  echo "<br> Optimised : Content includes keywords in underline"; 
  $GLOBALS['countofoptimised']++;
}

if($countofkeyinlinktext == 0)
{
  echo "<br> Warning : Hyperlink texts doesnt include Keywords";
  $GLOBALS['countofwarning']++;
}
else
{
  echo "<br> Optimised : Hyperlink texts include Keywords";
  $GLOBALS['countofoptimised']++;
}

if($countofsitemaphtml == 0)
{
  echo "<br> Warning : Website doesnt contain sitemap.html";
  $GLOBALS['countofwarning']++;
}
else
{
  echo "<br> Optimised : Website contains sitemap.html";
  $GLOBALS['countofoptimised']++;
}

if($countofsitemapxml == 0)
{
  echo "<br> Warning : Website doesnt contain sitemap.xml";
  $GLOBALS['countofwarning']++;
}
else
{
  echo "<br> Optimised : Website contains sitemap.xml";
  $GLOBALS['countofoptimised']++;
} 

echo "<br> <br> Error Count : ".$GLOBALS['countoferror'];
echo "<br> Warning Count : ".$GLOBALS['countofwarning'];
echo "<br> Optimised Count : ".$GLOBALS['countofoptimised'];
}
}
?>
</div>
</div>
</div>
<div class="footer_long">
<?php include('footer.php') ?>
</div>
</html>