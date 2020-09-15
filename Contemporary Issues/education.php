<?php

// GET QUERY STRING
  $s = (isset($_GET['s']) && !$_GET['s']=="")? $_GET['s'] : null;
    
//READ XML FILE
  $xmlFile = "education.xml";
  if (file_exists($xmlFile)) {
    $researchers = simplexml_load_file($xmlFile);
    $nodes = $researchers->Worksheet->Table->Row;
    //$nodes = $researchers->xpath("//Table");
    //var_dump($nodes);
  } else {
    exit('Failed to open XML file. Check filename.');
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>CLRC » Researchers</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/includes/master.css" type="text/css" media="screen" title="no title" charset="utf-8" />
    <script src="/includes/master.js" type="text/javascript" charset="utf-8"></script>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <a href="../aboutgraphics.html" title="About this graphic"><img src="../images/banner_top_general.gif" width="674" height="153" alt="Banner" /></a>
        <a class="ucdlink" href="http://www.ucdavis.edu" title="Navigate to UC Davis"><img src="../images/label_ucdavis.gif" width="75" height="23" alt="University of California, Davis Logo" title="Link to UC Davis"  /></a>      </div>
      <div id="subcontainer">
        <div id="menu">
          <ul>
            <li><a href="../mission.htm">Mission</a></li>
            <li><a href="../history.htm">History</a></li>
            <li><a href="../ucclr.htm">UCCLR</a></li>
            <li><a href="../director.htm">Director</a></li>
            <li><a href="../committee.htm">Committee</a></li>
            <li><a href="../afstaff.htm">Affiliated Faculty &amp; Staff</a></li>
            <li><a href="../staff.htm">CLRC Staff</a></li>
            <li><a href="../malcs">MALCS UCD Chapter</a></li>
            <li><a href="../news/newsletter_2007.htm">News</a></li>
            <li><a href="../publication.htm">Publications</a></li>
            <li><a href="../rclusters">Research Clusters</a></li>
            <li><a href="../Fellows/index.htm">Dissertation Fellowship</a></li>
            <li><a href="../rgrants">Research Grants</a></li>
            <li><a href="index.htm">Contemporary Issues</a></li>
            <li><a href="../links.htm">Resources</a></li>
            <li><a href="../index.htm">Home</a></li>            
          </ul>
        </div>
        <div id="content">
          <h2>UC Research on Chicana/o, Latina/o Education<br />
</h2>
          <h3>Websites</h3>
          <h3>Researchers</h3>
          <div id="search">
            <form action="education.php" method="get" accept-charset="utf-8">
              <p><input type="text" name="s" value="<?=$s?>" /><input type="submit" value="Search" /></p>
              <p><a href="#" onclick="return expand(0)">Collapse All</a> | <a href="#" onclick="return expand(1)">Expand All</a></p>
            </form>
          </div>
          <div id="list">
            <? if (count($nodes)>0) : ?>
            <table>
              <thead>
                <tr><th>Name, Title</th><th>Email, Webpage</th><th>Campus</th></tr>
              </thead>
              <? $y=0; foreach($nodes as $n) : ?>
              <? if (stristr($n->Cell[0]->Data,$s) || stristr($n->Cell[1]->Data,$s) || stristr($n->Cell[3]->Data,$s) || stristr($n->Cell[4]->Data,$s) || stristr($n->Cell[5]->Data,$s) || stristr($n->Cell[6]->Data,$s) ||  $s==null) : ?>
              
              <tbody id="researcher<?=$y?>" class="closed">
                <tr class="geninfo">
                  <td class="dept"><a href="#" onclick="return toggle(this,'researcher<?=$y?>')" title="click to expand"><?= "{$n->Cell[0]->Data} {$n->Cell[1]->Data}" ?></a><br /><?="{$n->Cell[3]->Data}, {$n->Cell[4]->Data}"?></td>
                  <td class="name"><?= str_replace("@"," at ",$n->Cell[2]->Data)."<br/> <a href=\"{$n->Cell[7]->Data}\">webpage</a>"?></td>
                  <td class="campus"><?= "{$n->Cell[5]->Data}"?></td>
                </tr>
                <tr class="desc">
                  <td colspan="3">
                    <em>Research Interests:</em> <?= "{$n->Cell[6]->Data}"?>
                  </td>
                </tr>
              </tbody>
              <? ++$y; ?>
              <? endif; endforeach; ?> 
            </table>
              <? if ($y==0) { 
                  echo "<dd>Sorry, there are no researchers that match your search.</dd>"; 
                  } 
              ?>
            <? else : ?>
            <p>We are sorry, your search did not provide any results.  Try other combinations.</p>
            <? endif; ?>
          
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
