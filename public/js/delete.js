function callDelete(name,url){
    let result = confirm('All information based on it will deleted too, Are you sure do you want to delete '+name+' ?');
    if(result){
        window.location.href=url;
    }
}
function deleteall(e,name){
    let result = confirm(`Are you sure you want to delete all  ${name}?`);
    if(result){
        e.submit();
    }
}