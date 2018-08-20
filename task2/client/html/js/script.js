function checkStorage(){
    showOnTable(entry);
}

function getCarList(){

    //let selectCat=document.getElementById("model");
    //let category=selectCat[selectCat.selectedIndex].text;
    //let num=document.getElementById("input").value;
    let url="";
    /*url=`https://jsonplaceholder.typicode.com/${category}`;
        url=`http://127.0.0.1/my/courses/soap/task2/server/index.php`;*/
    url=`http://127.0.0.1/my/courses/soap/task2/client/index.php?action=getCarList`;
    fetch(url)
        .then(response => response.json())
        .then(json=>{
            showOnTable(json);
        });

}

function showOnTable(entry){
    let t = document.getElementById("table");
    let table=objToTable(entry);
    t.innerHTML=objToTable(entry);
}

function objToTable(o){
    let table='';
    if (o.length){
        table+='<tr>';
        for(key in o[0]){
            table+='<th>'+key+'</th>';
        }
        table+='</tr>';

        for(row in o){
            table+='<tr>';
            for (cell in o[row]){
                table+='<td>'+o[row][cell]+'</td>';
            }

            table+='</tr>';
        }
    }else{

        table+='<tr>';
        for(key in o){
            table+='<th>'+key+'</th>';
        }
        table+='</tr>';

        table+='<tr>';
        for(key in o){
            table+='<td>'+o[key]+'</td>';
        }
        table+='</tr>';
    }
    return table;
}






