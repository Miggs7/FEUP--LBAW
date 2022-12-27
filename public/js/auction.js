
  let watch = document.querySelector("#watchForm"); 
  if(watch != null)
  watch.addEventListener('submit',watchAuction);

  let unwatch = document.querySelector("#unwatchForm");
  if(unwatch != null)
  unwatch.addEventListener('submit',unwatchAuction);


function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));

}

let watched = document.querySelector("#dom-target").innerHTML;

/*check if auction is watched on reload*/ 
try{
  if(!watched.localeCompare('true')){
    unwatch.style.display = 'block';
    watch.style.display = 'none';
  }
  //unwatched
  else {
    watch.style.display = 'block';
    unwatch.style.display = 'none';
  }
  }
  catch(e){
    console.log("error");
  }

let unwatchMSG = document.querySelector("#unwatchMsg");
let watchMsg = document.querySelector("#watchMsg");
let watchLogin = document.querySelector("#watchLogin");

function watchAuction(event) {
  event.preventDefault();
  let id_bidder = watch.querySelector("input[name=id_bidder]").value;
  let id_auction = watch.querySelector("input[name=id_auction]").value;
  sendAjaxRequest('post', '/watchList/' + id_auction + '/add',{id_bidder: id_bidder, id_auction: id_auction}, watchAuctionHandler);
}

function watchAuctionHandler() {
  try{

    let item = JSON.parse(this.responseText);
    console.log(item);

    unwatch.style.display = 'block';
    watch.style.display = 'none';
  
    unwatchMSG.style.display = 'none';
    watchMsg.style.display = 'block';

    watched = 'true';
  }
  catch(error){
    unwatch.style.display = 'none';
    watch.style.display = 'block';
    watchLogin.style.display = 'block';
  }
}

function unwatchAuction(event) {
  event.preventDefault();
  let id_bidder = unwatch.querySelector("input[name=id_bidder]").value;
  let id_auction = unwatch.querySelector("input[name=id_auction]").value;
  sendAjaxRequest('delete', '/watchList/' + id_auction + '/delete',{id_bidder: id_bidder, id_auction: id_auction}, unwatchAuctionHandler);
}

function unwatchAuctionHandler() {
  try{
  let item = JSON.parse(this.responseText);
  let unwatchMSG = document.querySelector("#unwatchMsg");
  unwatch.style.display = 'none';
  watch.style.display = 'block';

  watchMsg.style.display = 'none';
  unwatchMSG.style.display = 'block';

  watched = 'false';
  }
  catch(error){
    watchLogin.style.display = 'block';
  }
}


let reviewForm = document.querySelector("#reviewForm");
if(reviewForm != null){
  reviewForm.addEventListener('submit',review);
}

function review(event){
  event.preventDefault();

  let comment = reviewForm.querySelector("input[name=comment]").value;
  let author = reviewForm.querySelector("input[name=author]").value;
  let id_bidder = reviewForm.querySelector("input[name=id_bidder]").value;
  let id_auctioneer = reviewForm.querySelector("input[name=id_auctioneer]").value;
  let rating = reviewForm.querySelector("#selectRating").value;
  sendAjaxRequest('post', '/review/new',{id_bidder: id_bidder, id_auctioneer: id_auctioneer,comment: comment, author: author, rating: rating}, reviewHandler);
}

function reviewHandler(){
  try{
  reviewForm.style.display = "none";
  }
  catch(e){
    console.log("error");
  }
}

let formEdit = document.querySelector("#formAuctionEdit");
  if(formEdit != null){
    formEdit.addEventListener('submit', editAuction);
  }
  
  let auctionChanged = document.querySelector("#auctionChanged");
  let auctionName = document.querySelector(".auctionName");
  let auctionEnd = document.querySelector(".auctionEnd");
  let auctionDescription = document.querySelector(".auctionDescription");

  function editAuction(event){
    event.preventDefault();

    let name = formEdit.querySelector("input[name=name]").value;
    let id_auction = formEdit.querySelector("input[name=id]").value;
    let description = formEdit.querySelector("input[name=description]").value;
    let ending_date = formEdit.querySelector("input[name=ending_date]").value;

    sendAjaxRequest('put', '/auction/' + id_auction + '/edit',{name: name, id_auction: id_auction,description: description,ending_date: ending_date}, editAuctionHandler);
  }

  function editAuctionHandler() {
    let item = JSON.parse(this.responseText);
    if(auctionName) auctionName.innerHTML = item.name;
    if(auctionEnd != null) auctionEnd.innerHTML = "Ending date: " + item.ending_date;
    if(auctionDescription) auctionEnd.description = "Description: " + item.description;
    formEdit.style.display = "none";
    auctionChanged.style.display = "block";
  }


  let payForm = document.querySelector("#payForm");
  
  if(payForm != null){
    payForm.addEventListener('submit', payAuction);
  }


let payed = document.querySelector("#pay-target").innerHTML;
let reviewed = document.querySelector("#reviewed-target").innerHTML;

/*check if auction is watched on reload*/ 
try{
  if(!payed.localeCompare('true')){
    payForm.style.display = 'none';
    if(!review.localeCompare('true')){
      reviewForm.style.display = 'block';
    }
    else{
      reviewForm.style.display = 'none';
    }
  }
  else {
    payForm.style.display = 'block';
    //reviewForm.style.display = 'none';
  }
  }
  catch(e){
    console.log("error");
  }




function payAuction(event){
    event.preventDefault();

    let id_bidder = payForm.querySelector("input[name=id_bidder]").value;
    let id_auctioneer = payForm.querySelector("input[name=id_auctioneer]").value;
    let id_auction = payForm.querySelector("input[name=id_auction]").value;
    let value = payForm.querySelector("input[name=value]").value;

    sendAjaxRequest('post', '/auction/' + id_auction + '/pay',{id_bidder: id_bidder, id_auctioneer: id_auctioneer,id_auction: id_auction,value: value}, payAuctionHandler);
  }

function payAuctionHandler() {
    let item = JSON.parse(this.responseText);
    let payDone = document.querySelector("#payDone");
    payForm.style.display = "none";
    payDone.style.display = "block";
    reviewForm.style.display = "block";
  }