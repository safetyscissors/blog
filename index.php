<html>
<head>
  <title>blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php include('client/headIncludes.php')?>
</head>
<body>

<div class="row"><div class="col-md-offset-1 col-md-10">
<?php include('client/menu.php')?>
</div></div>

<!--
<div style="position:absolute; top:0; left:0; width:100%; height:100%;">
<form>
<textarea name="pageBody" id="pageBody">
hello there
</textarea>
</form>
</div>
-->
<div class="row">
<div class="col-md-12 decoration">
<div class="visible-lg" style="height:30%"></div>
<h1 class="col-md-offset-1 col-md-offset-1 fonty-inverse" style="padding:20px">space<br><small class="fonty-inverse"> for all language lovers to convene</small></h1> 
  </div>
  </div>

  <div class="row">
  <div class="col-md-offset-1 col-md-7">
    <ul class="article-list">
      <a href='#'><li class="article"><span class="article-title">
        Bringing life to a dead language
        </span><p>The article highlights one high school teacher’s attempt to make language learning fun and relatable for his students. He seems to be creating a more authentic, memorable learning experience through the use of immersion. It seems to be paying off as the students are making the connections</p>
      </li></a>
      <a href='#'><li class="article"><span class="article-title">
        Bringing life to a dead language
        </span><p>The article highlights one high school teacher’s attempt to make language learning fun and relatable for his students. He seems to be creating a more authentic, memorable learning experience through the use of immersion. It seems to be paying off as the students are making the connections</p>
      </li></a>
      <a href='#'><li class="article"><span class="article-title">
        Bringing life to a dead language
        </span><p>The article highlights one high school teacher’s attempt to make language learning fun and relatable for his students. He seems to be creating a more authentic, memorable learning experience through the use of immersion. It seems to be paying off as the students are making the connections</p>
      </li></a>
      <a href='#'><li class="article"><span class="article-title">
        Bringing life to a dead language
        </span><p>The article highlights one high school teacher’s attempt to make language learning fun and relatable for his students. He seems to be creating a more authentic, memorable learning experience through the use of immersion. It seems to be paying off as the students are making the connections</p>
      </li></a>
    </ul>
  </div>

  <div class="col-md-3">
    <div class="news-title">In the news</div>
    <ul class="news-list">
      <a href='#'><li class="news">Bringing life to a dead language</li></a>
      <a href='#'><li class="news">Bringing life to a dead language</li></a>
      <a href='#'><li class="news">Bringing life to a dead language</li></a>
      <a href='#'><li class="news">Bringing life to a dead language</li></a>
    </ul>
  </div>
  </div>

  <script> 
$('#pageBody').ckeditor();
$('form').ajaxSubmit({
  beforeSubmit:function(){
    console.log('hwat?');
  }
});

</script>
</body>
</html>
