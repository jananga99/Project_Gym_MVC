function createTable()
{
rn = window.prompt("Input number of rows", 1);
cn =2;
  
 for(var r=0;r<parseInt(rn,10);r++)
  {
   var x=document.getElementById('myTable').insertRow(r);
   for(var c=0;c<parseInt(cn,10);c++)  
    {
     var y=  x.insertCell(c);
    //  y.innerHTML="Row-"+r+" Column-"+c; 
    if(c==0){
        y.innerHTML='<input type="text" class="form-control" name="planTime'+ r  +  '"placeholder="Time"></input>';
    }
    else{
    
            y.innerHTML='<input type="text" class="form-control" name="planTodo'+r+  '"placeholder="todo"></input>';
    }

    }
   }
}



function getCheckboxValue() {  
    var res=" ";
    var inputs = document.querySelectorAll('.pl');   
    for (var i = 0; i < inputs.length; i++) {   
          
        if(inputs[i].checked == true){
            res = res + ","+inputs[i].checked.value;  //not working well
        }
    }   
    console.log(res);
}  