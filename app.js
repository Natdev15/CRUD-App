 let edits = document.getElementsByClassName('edit');
// let snoEdit = document.getElementById('snoEdit');
// let titleEdit = document.getElementById('titleEdit');
// let descEdit = document.getElementById('descEdit');

// Event listener for Edit 
Array.from(edits).forEach((element)=>{
    element.addEventListener('click', (e)=>{
            console.log("edit", );
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            desc = tr.getElementsByTagName("td")[1].innerText; 
            console.log(title, desc);
            titleEdit.value = title;
            descEdit.value = desc;
            snoEdit.value = e.target.id;
            console.log(e.target.id);
            $('#editModal').modal('toggle');
            
            myModal = document.getElementsById('editModal');
            myModal.toggle()
            
        }); 
    });
    
// Event listener for Delete 
let deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element)=>{
        element.addEventListener('click', (e)=>{
            console.log("edit", );
            sno = e.target.id.substr(1,);
            if(confirm("Are you sure to delete this")){
                console.log("yes");
                window.location = `/natu/CRUDAPP/index.php?delete=${sno}`;
            }
            else{
                console.log("no");
            }

          }) 
       })