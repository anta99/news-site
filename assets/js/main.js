var baseUrl;
$(document).ready(function(){
    $(".resMenu").click(function(){
        menuSlide(1);
    })
    $("#closeBtn").click(function () {
        menuSlide(0);
    })
    $(window).on("resize",function(){
        if(this.innerWidth>991){
            if (!$(".menu").hasClass("d-none")){
                menuSlide(0);
            }
        }
    })
    menuSearch.addEventListener("input",function(e){
        const searchQuery=this.value;
        if(searchQuery.length>=3){
            const postObj={
                searchQuery:searchQuery,
                search:true
            }
            ajaxReq("models/menuSearch.php",postObj,function(res){
                searchResultWrite(res);
                $("#searchResult").removeClass("d-none").addClass("d-block");
            })
        }
        else{
            $("#searchResult").removeClass("d-block").addClass("d-none");
        }
    })
    $(".searchBtn").click(function(){
        $(".searchMenu").removeClass("d-none");
        $(".searchMenu i").removeClass("fa-search").addClass("fa-times");
        $(".searchMenu i").removeClass("fa-search").addClass("fa-times");
    })
    $(".searchMenu i").click(function(){
        $(".searchMenu").addClass("d-none");
        $(".searchMenu i").addClass("fa-search").removeClass("fa-times");
    })
    $(".newsItem a").click(function () {
        writeInLS(1, []);
    });
    $("#submenu li a").click(function(e){
        const catIds=[this.dataset.catid];
        writeInLS(1,catIds);
    })
    
    //page=singleNews
    if(window.location.href.indexOf("page=singleNews")!=-1){
        baseUrl=window.location.href;
        $(".btnReply").click(function(){
            const parent = this.parentElement;
            commentFormPrint(parent);
        })
        $("#newCommentButton").click(function(){
            const parent=this.parentElement;
            commentFormPrint(parent);
        })
        $(".deleteComm").click(function(){
            console.log();
            const deleteObj={
                deleteId:this.dataset.commentid,
                deleteComm:true
            };
            ajaxReq("models/singleNews/deleteComments.php",deleteObj,function(res){
                console.log(res);
                location.reload();
            })
            
        })

    }
    //page=authorization
    else if (window.location.href.indexOf("page=authorization") != -1){
        //Sign in check
        $("#logInForm").submit(function(e){
            console.log("Idemo log");
            let ok=true;
            const username = document.querySelector("#logName");
            const password = document.querySelector("#logPass");
            !inputCheck(userNameRegex, username) ? ok = false : ok = true;
            !inputCheck(passwordRegex, password) ? ok = false : ok = true;
            if(ok){
                return true;
            }
            e.preventDefault();
        })
        //Register check
        $(".regBtn").click(function () {
            const firstName = document.querySelector("#regFirstName");
            const lastName = document.querySelector("#regLastName");
            const username = document.querySelector("#regUserName");
            const mail = document.querySelector("#regMail");
            const password = document.querySelector("#regPass");
            const confPassword = document.querySelector("#confPass");
            const terms = document.querySelector("#terms");
            let ok = true;
            !inputCheck(firstNameRegex, firstName) ? ok = false : null;
            !inputCheck(lastNameRegex, lastName) ? ok = false : null;
            !inputCheck(userNameRegex, username) ? ok = false : null;
            !inputCheck(emailRegex, mail) ? ok = false : null;
            !inputCheck(passwordRegex, password) ? ok = false : null;
            if (confPassword.value != password.value) {
                ok = false;
                confPassword.classList.add("inputError");
                confPassword.nextElementSibling.innerHTML = "Molimo vas ispravno popunite ovo polje";
            }
            else {
                confPassword.nextElementSibling.innerHTML = "";
                confPassword.classList.remove("inputError");
            }
            if (!terms.checked) {
                ok = false;
                terms.nextElementSibling.innerHTML = "Molimo vas prihvatite uslove korišćenja";
            }
            else {
                terms.nextElementSibling.innerHTML = "";
            }
            if(ok){
                const list = document.querySelector("#registerMessage");
                const registerObj={
                    firstName: firstName.value,
                    lastName:lastName.value,
                    username:username.value,
                    mail:mail.value,
                    password:password.value,
                    terms:terms.checked,
                    register:true
                };
                //console.log(registerObj);
                ajaxReq("models/authorization/register.php",registerObj,function(res){
                    console.log(res);
                    list.innerHTML = `<li class="list-group-item list-group-item-success">Molimo vas verifikujte svoj nalog klikom na ovaj <a href="index.php?page=verificationPage&code=${res}">link</a></li>`

                },function(xhr){
                    const errors=xhr.responseJSON;
                    let html="";
                    for(let i of errors){
                        html +=`<li class="list-group-item list-group-item-danger">${i}</li>`;
                    }
                    list.innerHTML=html;
                })
            }
        })
    }
    //page=news
    else if (window.location.href.indexOf("page=news") != -1){
        
        const parseFilters = JSON.parse(localStorage.getItem("filteri"));
        console.log(parseFilters);
        let filterObj={
            filter:"OK"
        }
        if (parseFilters!=null){
            filterObj.categoriesIds = parseFilters.categories;
            filterObj.page = parseFilters.page;
        }
        ajaxReq("models/news/filterNews.php", filterObj, function (res) {
            printNews(res.news);
            paginationPrint(res.pagesNumber);
            if (parseFilters != null) {
                colorActiveCategories(parseFilters.categories);
                colorPagination(parseFilters.page);
            }
        });
        $(".categoryNews a").click(function(e){
            e.preventDefault();
            this.parentElement.classList.toggle("categoryActive");
            //console.log(categoriesIds);
            const filterObj={
                categoriesIds: getActiveCategories(),
                page:1,
                filter:"OK"
            };
            writeInLS(1,getActiveCategories());
            ajaxReq("models/news/filterNews.php",filterObj,function(res){
                printNews(res.news);
                paginationPrint(res.pagesNumber);
            });
            
            
        })
        //$(".page-link").click(changePage);
    }
    //User profile
    else if (window.location.href.indexOf("page=userProfile") != -1){
        const hidden = document.querySelector("#userhidden").value;
        $(".changeInfo").click(function(){
            const input=this.parentElement.querySelector("input");
            input.removeAttribute("readonly","readonly");
            input.classList.add("activeInfo");
            document.querySelector(".changeBtn").classList.remove("d-none");
        });
        $(".resetBtn").click(function(){
            const profileChangeForm = document.querySelectorAll("#profileChange input");
            profileChangeForm.forEach(input=>{
                input.setAttribute("readonly", "readonly");
                input.classList.remove("activeInfo");
            });
            this.parentElement.classList.add("d-none");
        });
        $("#changePass").click(function(){
            const oldPassword=document.querySelector("#oldPassword");
            const newPassword=document.querySelector("#newPassword");
            const confPassword = document.querySelector("#confirmPass");
            const passwordMessage = document.querySelector("#passwordMessage");
            passwordMessage.innerHTML="";
            passwordMessage.classList.add("d-none");
            let ok= true;
            if(!inputCheck(passwordRegex,oldPassword)){
                ok=false;
            }
            if (!inputCheck(passwordRegex, newPassword)){
                ok=false;
            }
            else{
                if(newPassword.value!=confPassword.value){
                    ok=false;
                    confPassword.nextElementSibling.innerHTML ="Molimo vas da ispravno popunite ovo polje";
                }
                else{
                    confPassword.nextElementSibling.innerHTML = "";
                }
            }
            if(ok){
                const postObj={
                    userId: hidden,
                    oldPassword:oldPassword.value,
                    newPassword:newPassword.value,
                    confirmPass: confPassword.value,
                    change:true
                }
                ajaxReq("models/userProfile/changePassword.php",postObj,function(res){
                    console.log(res);
                    passwordMessage.innerHTML = `<p>Lozinka uspesno promenjena</p>`;
                    passwordMessage.classList.add("alert-success");
                    passwordMessage.classList.remove("alert-danger","d-none");
                    oldPassword.nextElementSibling.innerHTML="";
                    confPassword.nextElementSibling.innerHTML="";
                    newPassword.nextElementSibling.classList.add("text-muted");
                    newPassword.nextElementSibling.innerHTML ="Lozinka mora imati najmanje 8 karaktera";
                    document.querySelector("#changePasswordForm").reset();
                },function(xhr){
                    const errors=xhr.responseJSON;
                    console.log(errors);
                    if (errors.hasOwnProperty("old")){
                        oldPassword.nextElementSibling.innerHTML=errors.old;
                        oldPassword.nextElementSibling.classList.add("text-danger");
                    }
                    if (errors.hasOwnProperty("new")){
                        newPassword.nextElementSibling.innerHTML=errors.new;
                        newPassword.nextElementSibling.classList.add("text-danger");
                    }
                    if (errors.hasOwnProperty("confirm")){
                        confPassword.nextElementSibling.innerHTML = errors.confirm;
                    }
                    if (errors.hasOwnProperty("updateErr")){
                        confPassword.nextElementSibling.innerHTML = errors.updateErr;
                    }
                })
            }
        });
        $("#profileChange").submit(function(e){
            const username = document.querySelector("#username");
            const hiddenName = document.querySelector("#changeUserName");
            if(inputCheck(userNameRegex,username)){
                if(username.value!=hiddenName.value){
                    return true;
                }
                else{
                    username.nextElementSibling.innerHTML="Novo korisničko ime mora biti drugačije od trentunog";
                    username.nextElementSibling.classList.add("text-danger");
                    e.preventDefault();
                }
            }
            e.preventDefault();
        });
    }
    //page=contact
    else if(window.location.href.indexOf("page=contact")!= -1){
        $("#sendBtn").click(function(){
            const contactName = document.querySelector("#contactName");
            const contactMail = document.querySelector("#contactMail");
            const message = document.querySelector("#contactMessage");
            const alert = document.querySelector("#alertMsg");
            let ok=true;
            !inputCheck(contactNameRegex,contactName) ? ok=false : null;
            !inputCheck(emailRegex, contactMail) ? ok = false : null;
            !inputCheck(messageRegex, message) ? ok = false : null;
            if(ok){
                const postObj={
                    name:contactName.value,
                    email:contactMail.value,
                    message:message.value,
                    contact:true
                };
                ajaxReq("models/contact/inbox.php",postObj,function(res){
                    if(alert!=null){
                        alert.remove();
                        alertMsgPopUp(true, res);
                    }
                    else{
                        alertMsgPopUp(true, res);
                    }
                    console.log(res);
                },function(xhr){
                    const error=xhr.responseJSON;
                    if(alert!= null) {
                        alert.remove();
                        alertMsgPopUp(false, error);
                    }
                    else {
                        alertMsgPopUp(false, error);
                    }
                    console.log(xhr);
                });
            }
        });
    }
    //page=addNews
    else if (window.location.href.indexOf("page=addNews") != -1) {
        $("#addNewNews").click(function(){
          newsCheck(false);

        });
    }
    //page=adminPanel
    else if (window.location.href.indexOf("page=adminPanel") != -1){
        $(".page-link").click(changePage);
        $(".deleteNewsLink").click(deleteNews);
    }
    //index
    else{
        $.ajax({
            url: "models/mainPage/sliderNews.php",
            method:"GET",
            dataType:"json",
            success:function(res){
                sliderWrite(res);
            },
            error:function(xhr){
                console.log(xhr);
            }
        });
        $("#voteBtn").click(function(){
            const button=this;
            const answers = [...document.querySelectorAll("input[name='surveyAnswer']")];
            const user = document.querySelector("#surveyUser");
            let voted=false;
            let answerId;
            for(let i of answers){
                if(i.checked){
                    voted=true;
                    answerId = i.dataset.answerid;
                    break;
                }
            }
            if(voted){
                const postObj={
                    userId:user.value,
                    answer:answerId,
                    vote:"OK"
                };
                ajaxReq("models/mainPage/surveyAnswer.php",postObj,function(res){
                    console.log("Hvala za učešće u anketi");
                    button.nextElementSibling.innerHTML = `<p class="text-success text-center m-0">${res}</p>`;
                },function(xhr){
                    const errors=xhr.responseJSON;
                    console.log(errors);
                    let html="";
                    for(let i of errors){
                        html +=`<p class="text-danger text-center m-0">${i}</p>`;
                    }
                    button.nextElementSibling.innerHTML=html;
                });
            }
            else{
                button.nextElementSibling.innerHTML =`<p class="text-danger text-center m-0">Morate izabrati neki odgovor</p>`;
            }
        });
    }
})
//Regex
const firstNameRegex =/^[A-ZŠĐČŽĆ][a-zšđčćž]{2,14}(\s[A-Z][a-z]{2,14})*$/;
const lastNameRegex = /^[A-ZŠĐČŽĆ][a-zšđčćž]{2,24}(\s[A-Z][a-z]{2,24})*$/;
const userNameRegex=/^[A-zčžćšđČŽĆŠĐ0-9\?\!\.]{3,30}$/;
const emailRegex = /^[a-z\.\!\?0-9]{4,40}\@[a-z0-9]{3,15}(\.[a-z0-9]{3,15})*\.[a-z]{2,3}$/;
const passwordRegex=/^[A-z0-9\.\?\,\s\!\@\#]{8,50}$/;
const contactNameRegex = /^[A-ZŠĐČŽĆ][a-zšđčćž]{2,19}(\s[A-ZŠĐČŽĆ][a-zšđčćž]{2,19})*$/;
const messageRegex = /^[A-zšđčćžŠĐČŽĆ0-9\s\?\.\,\!\"\'\-\)\(\:]{2,}$/;
//const newsHeaderRegex=/^[A-ZŠĐČŽĆ][a-zšđčžć\s\?\!\.0-9]{1,59}$/;
const newsHeaderRegex = /^[A-ZŠĐČŽĆ][A-zŠĐČŽĆšđčćž\s\,\.\!\?\-\-\)\(\:]{0,59}$/;
const newsDescRegex = /^[A-ZŠĐČŽĆ][A-zŠĐČŽĆšđčžć\s\?\!\.0-9\"\'\-\)\(\:]{1,199}$/;
const imageRegex = /^image\/(jpeg|jpg|png)$/;
const userIcon = document.querySelector("#userIcon");
const menuSearch = document.querySelector("#menuSearch");
//Function declaration
let searchMenuWidth="75%";
function menuSlide(con){
    if(con){
        $(".menu").addClass("fixedMenu");
        $(".menu").removeClass("d-none");
        $("body").addClass("overflow-hidden");
    }
    else{
        $(".menu").addClass("d-none");
        $(".menu").removeClass("fixedMenu");
        $("body").removeClass("overflow-hidden");
    }
}
function sliderWrite(arr){
    const target = document.querySelector(".carousel-inner");
    let html = "";
    for (let i of arr) {
        html += `<div class="carousel-item">
            <div class="slika" style="background-image: linear-gradient(rgba(0,0,0,0.1),rgba(0,0,0,0.3)),url(assets/images/${i.slikaSrc});">
                <div class="naslov p-1 p-md-3 ml-md-5 p-lg-3">
                        <h5 class="cat badge badge-secondary">${i.category}</h5>
                        <h2><a href="index.php?page=singleNews&id=${i.id}">${i.naslov}</a></h2>
                        <div class="post-details">
                            <span><i class="fa fa-calendar"></i>
                            ${i.datum}</span>
                            <span><i class="fa fa-user mx-1"></i> ${i.author}</span>
                            <span><i class="fa fa-comment mx-1"></i>${i.commentCount}</span>
                        </div>
                    </div>
                </div>
            </div>`;
    }
    target.innerHTML = html;
    document.querySelectorAll(".carousel-item")[0].classList.add("active");
}
function commentFormPrint(parent){
    if (!parent.querySelector(".commentArea")) {
        let htmlForm = document.createElement("div");
        htmlForm.setAttribute("class", "col-12");
        htmlForm.innerHTML += `<form action="" id="komentarVest" name="komentarVest" method="POST">
        <textarea name="commentArea" class="commentArea" rows="10" placeholder="Ostavite komentar..."></textarea>
        <p class="text-danger"></p>
        <button class="btn buttonCustom commReply mb-3">Posalji</button>
        <button class="btn buttonCustom replyClose mb-3">Zatvori</button>
         </form>
    `;
        parent.appendChild(htmlForm);
        $(".commReply").click(function (e) {
            e.preventDefault();
            const reply = this.parentElement.querySelector(".commentArea");
            const newsId = document.querySelector("#newsId").value;
            const parentType = this.parentElement.parentElement.parentElement.getAttribute("id");
            const commentObj={};
            commentObj.newsId=newsId;
            commentObj.user=1;
            if(reply.value!=""){
                reply.nextElementSibling.innerHTML="";
                commentObj.reply=reply.value;
                if (parentType != "newComment") {
                    console.log("Novi komentar");
                    const parentCommentId = this.parentElement.parentElement.parentElement.parentElement.dataset.parentid;
                    commentObj.parentComment = parentCommentId;
                }
                commentObj.addComment = true;
                console.log(commentObj);
                ajaxReq("models/singleNews/addComment.php", commentObj, function (res) {
                    console.log(res);
                    printComments(res.comments,res.replies);
                    const url = baseUrl + "#relatedNews";
                    window.location = url;
                    document.querySelector(".comCount").innerHTML=res.commentsCount.count;
                    document.querySelector(".replyClose").click();
                });
            }
            else{
                reply.nextElementSibling.innerHTML = "Komentar ne sme biti prazan!";
            }
        })
        $(".replyClose").click(function (e){
            e.preventDefault();
            this.parentElement.parentElement.remove();
        })
    }
    else{
        console.log("Forma vec postoji");
    }
}
function inputCheck(regex,elem){
    if (!regex.test(elem.value.trim())){
        elem.classList.add("inputError");
        elem.nextElementSibling.classList.remove("text-muted");
        elem.nextElementSibling.classList.add("text-danger");
        elem.nextElementSibling.innerHTML="Molimo vas da ispravno popunite ovo polje";
        return false;
    }
    else{
        elem.classList.remove("inputError");
        elem.nextElementSibling.classList.remove("text-danger");
        elem.nextElementSibling.classList.add("text-muted");
        elem.nextElementSibling.innerHTML = "";
        return true;
    }
}
function ajaxReq(url,postObj,success,error=function(xhr){console.log(xhr)}){
    $.ajax({
        url:url,
        method:"POST",
        dataType:"json",
        data:postObj,
        success:success,
        error:error
    })
}
function searchResultWrite(arr){
    const target = document.querySelector("#searchResult ul");
    let html="";
    if(arr.length!=0){
        for (let i of arr) {
            html += `<li><a href="index.php?page=singleNews&id=${i.id}" target="_blank">${i.naslov}</a></li>`;
        }
    }
    else{
        html += `<li><a href="#">Nazalost nema rezultata</a></li>`;
    }
    target.innerHTML=html;
}
function printComments(comments,replies){
    const commentSection = document.querySelector("#commentSection");
    let html="";
    for (let i of comments){
        html +=`
        <div class="commentHolder col-12" data-parentid="${i.id}">
            <div class="position-relative p-3 mb-2 comment">
                <span class="font-weight-bold">${i.username}</span>
                <span class="comDate position-absolute">${i.datum}</span>
                <p class="mt-3">${i.tekst}</p>
                <button class="btn buttonCustom btnReply">Odgovori</button>
            </div>`;
        if(!i.roditelj_id){
            const filteredReplies = replies.filter(reply => reply.roditelj_id==i.id);
            html +=`<div class="repliesHolder">`;
            for (let j of filteredReplies){
                html +=` 
                <div class="position-relative p-3 mb-2 comment reply">
                    <span class="font-weight-bold">${j.username}</span>
                    <span class="comDate position-absolute">${j.datum}</span>
                    <p class="mt-3">${j.tekst}</p>
                </div>`;
            }
            html +=`</div>`;
        }
        html+=`</div>`;
    }
    commentSection.innerHTML=html;
}
function printNews(arr){
    const target = document.querySelector("#newsContainer");
    let html="";
    if(arr.length!=0){
        for (let i of arr) {
            html += `
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-1 p-lg-3 mb-2">
            <div class="card singleNewsContainer">
                <a href="index.php?page=singleNews&id=${i.id}">
                    <img class="card-img-top img" src="assets/images/${i.src}" alt="${i.naslov}" />
                </a>
                <span class="cat badge badge-secondary mt-4 ml-3">${i.category}</span>
                <div class="card-body">
                    <h2 class="card-title"><a href="index.php?page=singleNews&id=${i.id}">${i.naslov}</a></h2>
                    <div class="news-details my-2 text-black-50">
                        <span><i class="fa fa-calendar"></i>
                        ${i.datum}</span>
                        <span><i class="fa fa-user mx-1"></i> ${i.author}</span>
                    </div>
                    <p class="card-text ">${i.opis}</p>
                    <a href="index.php?page=singleNews&id=${i.id}" class="btn btn-primary d-block readNews">Pročitaj još</a>
                </div>
            </div>
        </div>`;
        }
    }
    else{
        html+=`
        <div class="col-12 noNews text-center">
        <h3 class="">Nažalost nema vesti za izabrane kategorije</h3>
        </div>`;
    }
    target.innerHTML=html;
}
function paginationPrint(pagesNumber,admin=false){
    const target = document.querySelector(".pagination");
    let html="";
    for(let i=1;i<=pagesNumber;i++){
        i == 1 ? html += `<li class="page-item active"><a href="#" class="page-link">${i}</a></li>` : html +=`<li class="page-item"><a href="#" class="page-link">${i}</a></li>`;
    }
    target.innerHTML=html;
    $(".page-link").click(changePage);
}
function getActiveCategories(){
    const activeCategories = [...document.querySelectorAll(".categoryActive a")];
    const categoriesIds = activeCategories.map(cat => cat.dataset.catid);
    //console.log([...document.querySelectorAll(".categoryActive a[data-catid='5']")])
    return categoriesIds;
}
function changePage(){
    const pageNumber = Number(this.innerHTML);
    $(".page-item").removeClass("active");
    this.parentElement.classList.add("active");
    let admin=false;
    if(window.location.href.indexOf("page=adminPanel")!=-1){
        admin=true;
    }
    if(admin){
        const postObj = {
            page: pageNumber,
            categoriesIds: [],
            filter: "OK"
        }
        writeInLS(pageNumber, getActiveCategories());
        ajaxReq("models/news/filterNews.php", postObj, function (res) {
            printAdminNews(res.news);
        });
    }
    else{
        const postObj = {
            page: pageNumber,
            categoriesIds: getActiveCategories(),
            filter: "OK"
        }
        writeInLS(pageNumber, getActiveCategories());
        ajaxReq("models/news/filterNews.php", postObj, function (res) {
            printNews(res.news);
        });
    }
    
}
function colorActiveCategories(arr){
    for(let i of arr){
        document.querySelector(`.categoryNews a[data-catid='${i}']`).parentElement.classList.add("categoryActive");
    }
}
function colorPagination(activePage){
    $(".page-item").removeClass("active");
    const pageToColor=[...document.querySelectorAll(".page-link")].filter(page=>page.innerHTML==activePage);
    pageToColor[0].parentElement.classList.add("active");
}
function writeInLS(page,cat){
    const obj={
        page:page,
        categories:cat
    }
    localStorage.setItem("filteri",JSON.stringify(obj));
}
function alertMsgPopUp(result,messages){
    const body=document.querySelector("body");
    let alertHtml=`
    <div class="col-12 col-md-7 col-lg-5 text-center mx-auto p-3 alert alert-dismissible fade show" id="alertMsg" role="alert">
        <div id="msg">`;
    for(let i of messages){
        alertHtml+=`<p class="m-0">${i}</p>`;
    }
    alertHtml+=`</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>`;
    $("body").append(alertHtml);
    const alert = document.querySelector("#alertMsg");
    result ? alert.classList.add("alert-success", "slideAlert") : alert.classList.add("alert-danger", "slideAlert");
}
function formDataCheck(update,obj,propName,regex,visibleValue,hiddenValue=null){
    if(inputCheck(regex, visibleValue)) {
        if (update) {
            if (visibleValue.value != hiddenValue.value) {
                obj.append(propName, visibleValue.value);
            }
        }
        else {
            obj.append(propName, visibleValue.value);
        }
        return true;
    }
    return false;
}
function newsCheck(update){
    var postObj = new FormData();
    const header = document.querySelector("#newsHeader");
    const desc = document.querySelector("#newsDesc");
    const category = document.querySelector("#newsCat");
    const author = document.querySelector("#newsAuthor");
    const text = document.querySelector("#newsText");
    const image = document.querySelector("#newsImg");
    const hiddenHeader = document.querySelector("#newsHeaderHidden");
    let ok=true;
    !formDataCheck(update,postObj,"header",newsHeaderRegex,header) ? ok=false : null;
    !formDataCheck(update, postObj,"desc", newsDescRegex, desc) ? ok=false :null;
    !formDataCheck(update, postObj, "text",messageRegex, text) ? ok = false : null;
    if(category.value=="0"){
        ok=false;
        category.nextElementSibling.innerHTML="Morate izabrati kategoriju";
    }
    else{
        if (update) {
            if (category.value != hiddenCategory.value) {
                postObj.append("category", category.value);
            }
        }
        else {
            postObj.append("category", category.value);
        }
        category.nextElementSibling.innerHTML = "";
    }
    if (author.value == "0") {
        ok = false;
        author.nextElementSibling.innerHTML = "Morate izabrati autora";
    }
    else {
        if(update){
            if(author.value!=hiddenAuthor.value){
                postObj.append("author", author.value);
            }
        }
        else{
            postObj.append("author", author.value);
        }
        author.nextElementSibling.innerHTML = "";
        
    }
    if(image.value!=""){
        if (!imageRegex.test(image.files[0].type)) {
            ok=false;
            image.nextElementSibling.innerHTML = "Format slike nije dobar.Molimo vas izaberite drugi format.";
        }
        else{
            image.nextElementSibling.innerHTML ="";
            postObj.append("image",image.files[0]);
        }
    }
    else{
        ok=false;
        image.nextElementSibling.innerHTML="Morate izabrati sliku";
    }
    if(ok){
        postObj.append("add",true);
        $.ajax({
            url:"models/admin/add/news.php",
            method:"POST",
            contentType: false,
            cache: false,
            processData: false,
            data: postObj,
            success:function(res){
                console.log(res);
                const successMsg=`Vest uspešno dodata!Pogledajte vest na ovom <a href="${res}">linku</a>`;
                alertMsgPopUp(true, [successMsg]);
            },
            error:function(xhr){
                console.log(xhr);
                const errors=xhr.responseJSON;
                alertMsgPopUp(false, errors);
            }
        });
    }
    
}
function printAdminNews(arr){
    const target = document.querySelector(".table tbody");
    let html=``;
    for(let i of arr){
        html+=
        `
        <tr>
            <th scope="row">${i.id}</th>
            <td>${i.naslov}</td>
            <td>${i.category}</td>
            <td>${i.author}</td>
            <td>${i.datum}</td>
            <td>
                <a href="index.php?page=addNews&updateid=${i.id}" class="updateNewsLink changeNewsLinks ml-2">Izmeni</a>
                <a href="#" class="deleteNewsLink changeNewsLinks ml-2" data-deleteid="${i.id}">Obriši</a>
            </td>
        </tr>
        `;
    }
    target.innerHTML=html;
    $(".deleteNewsLink").click(deleteNews);
}
function deleteNews(){
    const page = Number(document.querySelector(".pagination .active a").innerHTML);
    const deleteId = this.dataset.deleteid;
    const postObj = {
        deleteId: deleteId,
        page: page,
        deleteNews: true
    };
    ajaxReq("models/admin/delete/news.php",postObj,function(res){
        printAdminNews(res.news);
        paginationPrint(res.pagesNumber);
    },function(xhr){
        console.log(xhr);
        alert(xhr.responseJSON);
    });
}