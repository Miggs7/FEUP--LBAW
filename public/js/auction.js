
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

function watchAuction(event) {
  event.preventDefault();
  let id_bidder = watch.querySelector("input[name=id_bidder]").value;
  let id_auction = watch.querySelector("input[name=id_auction]").value;
  sendAjaxRequest('post', '/watchList/' + id_auction + '/add',{id_bidder: id_bidder, id_auction: id_auction}, watchAuctionHandler);
}

function watchAuctionHandler() {
  let item = JSON.parse(this.responseText);
  unwatch.style.display = 'block';
  watch.style.display = 'none';

  unwatchMSG.style.display = 'none';
  watchMsg.style.display = 'block';
}

function unwatchAuction(event) {
  event.preventDefault();
  let id_bidder = unwatch.querySelector("input[name=id_bidder]").value;
  let id_auction = unwatch.querySelector("input[name=id_auction]").value;
  sendAjaxRequest('delete', '/watchList/' + id_auction + '/delete',{id_bidder: id_bidder, id_auction: id_auction}, unwatchAuctionHandler);
}

function unwatchAuctionHandler() {
  let item = JSON.parse(this.responseText);
  let unwatchMSG = document.querySelector("#unwatchMsg");
  unwatch.style.display = 'none';
  watch.style.display = 'block';

  watchMsg.style.display = 'none';
  unwatchMSG.style.display = 'block';
}

    
    let bidding = document.querySelector("#bidForm");
    if(bidding != null){
      bidding.addEventListener('submit', bidAuction);
    }
    let lowBid = document.querySelector("#lowBid");
    let bidOff = document.querySelector("#bidOff");
    let bidSucess = document.querySelector("#bidSucess");

    function bidAuction(event){
      event.preventDefault();
  
      let id_bidder = bidding.querySelector("input[name=id_bidder]").value;
      let id_auction = bidding.querySelector("input[name=id]").value;
      let current_bid = bidding.querySelector("input[name=current_bid]").value;
      let bid_value = bidding.querySelector("input[name=bid_value]").value;
      sendAjaxRequest('put', '/auction/' + id_auction + '/bid',{id_bidder: id_bidder, id_auction: id_auction,current_bid: current_bid,bid_value: bid_value}, auctionBidHandler);
    }

    function auctionBidHandler() {
      let item = JSON.parse(this.responseText);
      bidSucess.style.display = 'block';
      let currentBid = document.querySelector(".current");
      console.log(currentBid);
      currentBid.innerHTML = "Current Bid: " + item.bid_value + "$";
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

    /*auctionChanged.style.display = "none";
    formEdit.style.display = "block";
    */

    let name = formEdit.querySelector("input[name=name]").value;
    let id_auction = formEdit.querySelector("input[name=id]").value;
    let description = formEdit.querySelector("input[name=description]").value;
    let ending_date = formEdit.querySelector("input[name=ending_date]").value;

    sendAjaxRequest('put', '/auction/' + id_auction + '/edit',{name: name, id_auction: id_auction,description: description,ending_date: ending_date}, editAuctionHandler);
  }

  function editAuctionHandler() {
    let item = JSON.parse(this.responseText);
    if(auctionName) auctionName.innerHTML = item.name;
    if(auctionEnd) auctionEnd.innerHTML = "Ending date: " + item.ending_date;
    if(auctionDescription) auctionEnd.description = "Description: " + item.description;
    formEdit.style.display = "none";
    auctionChanged.style.display = "block";
  }