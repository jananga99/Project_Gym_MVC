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
        y.innerHTML='<input type="text" class="form-control" name="planname" placeholder="Time"></input>';
    }
    else{
    
            y.innerHTML='<input type="text" class="form-control" name="planname" placeholder="todo"></input>';
    }

    }
   }
}