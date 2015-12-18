$(document).ready(getBlogList);

function getBlogList(){
  REQUEST.send('list','get',function(data){
    var serverData = (data)? JSON.parse(data) : '';
    if(serverData.hasOwnProperty('errors')){
      $('#blogListing').html(serverData.errors);
    } else{
      var output='<ul id="blogList">';
      for(var i=0;i<serverData.length;i++){
        var blog=serverData[i];
        var bid =blog['blogId'];
        output+=tableRow(bid,blog);
      }
      output+='</ul>';
      $('#blogListing').html(output);
    }
  });
}

function tableRow(pid,blog){
  var row = '<a href="blog?id='+pid+'"><li>';
  row += '<div class="blogListImg"></div>';
  row += '<div class="blogListName"><h4>'+blog['blogName']+'</h4></div>';
  row += '<div class="blogListDesc">'+blog['blogDesc']+'</div>';
console.log(blog);
  /*
  row += '<td><input id="blogUpdateName'+pid+'" value="' + blog['blogName'] + '"></td>'
  row += '<td><input id="blogUpdateTitle'+pid+'" value="' + blog['blogTitle'] + '"></td>'
  row += '<td><input id="blogUpdateDesc'+pid+'" value="' + blog['blogDesc'] + '"></td>'
  row += '<td><button class="blogUpdateSave" id="'+pid+'">save</button></td>'
  row += '<td><button class="blogUpdateEdit" id="'+pid+'">edit</button></td>'
  row += '<td><button class="blogUpdateDelete" id="'+pid+'">delete</button></td>'
  */
  return row+'</li></a>';
}