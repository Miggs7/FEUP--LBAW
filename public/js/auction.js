
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

    
    let bidding = document.querySelector("#bidForm");
    if(bidding != null){
      bidding.addEventListener('submit', bidAuction);
    }
    let lowBid = document.querySelector("#lowBid");
    let bidOff = document.querySelector("#bidOff");
    let bidSucess = document.querySelector("#bidSucess");
    let lastBid = document.querySelector("#bid-row");
    let bidCount = document.querySelector("#target-bid-count").innerHTML;
    let bidCountInt = parseInt(document.querySelector("#target-bid-count").innerHTML,10);

    function bidAuction(event){
      event.preventDefault();
  
      let id_bidder = bidding.querySelector("input[name=id_bidder]").value;
      let id_auction = bidding.querySelector("input[name=id]").value;
      let current_bid = bidding.querySelector("input[name=current_bid]").value;
      let bid_value = bidding.querySelector("input[name=bid_value]").value;
      sendAjaxRequest('put', '/auction/' + id_auction + '/bid',{id_bidder: id_bidder, id_auction: id_auction,current_bid: current_bid,bid_value: bid_value}, auctionBidHandler);
    }

    function auctionBidHandler() {
      try{
        let item = JSON.parse(this.responseText);
        bidSucess.style.display = 'block';

        if(!watched.localeCompare('false')){
          unwatch.style.display = 'block';
          unwatchMSG.style.display = 'none';
  
          watchMsg.style.display = 'block';
          watch.style.display = 'none';
        }

        let currentBid = document.querySelector(".current");
        currentBid.innerHTML = "Current Bid: " + item.bid_value + "$";


        /*Increase auction minimum value*/
        let input_bid_value = bidding.querySelector("input[name=bid_value]");
        input_bid_value.setAttribute("min",parseInt(item.bid_value)+1);

        let newBid = document.createElement("tr");
        lastBid.appendChild(newBid);

        let numberBid = document.createElement("th");
        bidCountInt++;
        numberBid.innerHTML = bidCountInt;
        newBid.appendChild(numberBid);

        document.querySelector("#target-bid-count").innerHTML = bidCountInt + " bids";

        let bidderCell = document.createElement("td");
        bidderCell.innerHTML = item.bidder;
        newBid.appendChild(bidderCell);

        let bidValue = document.createElement("td");
        bidValue.innerHTML = item.bid_value + "$";
        newBid.appendChild(bidValue);

      }
      catch(error){
        watchLogin.style.display = 'block';
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