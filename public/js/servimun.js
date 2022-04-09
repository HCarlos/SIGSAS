
var axios = axios.create();// require("axios").default;


function getUser(){
        var CURP = "HIRC711126HTCDZR01";
        var bodyFormData = new FormData();
        bodyFormData.append('search', CURP);


    axios({
        method: "get",
        url: "/getCURP",
        data: bodyFormData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json;charset=utf-8',
            'Accept': 'application/json'
        },
    })
        .then(function (response) {
            // alert( (response.data.data)[10].curp );
            response.data.data.forEach(function(item) {
                console.log("found: ", item)
                console.log("found id: ", item.id)
                // alert(item.curp);
            });
            console.log(response.data.data);
        })
        .catch(function (response) {
            alert("Hola Mundo 2");
            console.log(response);
        });

}

//getUser();

