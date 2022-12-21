    let watch = document.querySelector("#watchForm");
    let watchMSG = document.querySelector("#watchMsg");

    let unwatch = document.querySelector("#unwatchForm");
    let unwatchMSG = document.querySelector("#unwatchMsg");

    let watched = document.querySelector("#dom-target").innerHTML;

    let id_bidder = $('input[name=id_bidder]').val();
    let id_auction = $('input[name=id_auction]').val();
    let token = $('input[name=_token]').val();

    //unwatch 
    if(!watched.localeCompare('true')){
      unwatch.style.display = 'block';
      watch.style.display = 'none';
    }
    //unwatched
    else {
      watch.style.display = 'block';
      unwatch.style.display = 'none';
    }
    
    // add to watch list
    $(watch).on("submit",function(e){
    e.preventDefault();
        $.ajax({
          url: "/watchList/"+ id_bidder + "/add",
          type:"POST",
          data:{
            "_token": token,
            id_bidder: id_bidder,
            id_auction: id_auction,
          },
          success:function(response){
            watch.style.display = 'none';
            unwatch.style.display = 'block';

            watchMSG.style.display = 'block';
            unwatchMSG.style.display = 'none';
          },
          error: function(response) {
            const warning = document.createElement("div");
            warning.textContent = "please log-in";
            warning.className = "warning";
            watch.appendChild(warning);
            console.log("error");
          },
    });
});

    //remove from watch list
    $(unwatch).on("submit",function(e){
        e.preventDefault();
        let count = 0;
    
        let id_bidder = $('input[name=id_bidder]').val();
        let id_auction = $('input[name=id_auction]').val();
        let token = $('input[name=_token]').val();
    
    
            $.ajax({
              url: "/watchList/"+ id_bidder + "/delete",
              type:"DELETE",
              data:{
                "_token": token,
                id_bidder: id_bidder,
                id_auction: id_auction,
              },
              success:function(response){
                unwatch.style.display = 'none';
                watch.style.display = 'block';
                watchMSG.style.display = 'none';
                unwatchMSG.style.display = 'block';
              },
              error: function(response) {
                console.log("error");
              },
        });
      
    });
    
    let bidding = document.querySelector("#bidForm");
    let lowBid = document.querySelector("#lowBid");
    let bidOff = document.querySelector("#bidOff");
    let bidSucess = document.querySelector("#bidSucess");
    let currentBid = document.querySelector(".current");

    $(bidding).on("submit",function(e){
      e.preventDefault();
      let count = 0;
  
      let id_bidder = $('input[name=id_bidder]').val();
      let id_auction = $('input[name=id]').val();
      let current_bid = $('input[name=current_bid]').val();
      let bid_value = $('input[name=bid_value]').val();
      let token = $('input[name=_token]').val();

          $.ajax({
            url: "/auction/"+ id_auction + "/bid",
            type:"PUT",
            data:{
              "_token": token,
              current_bid: current_bid,
              id_bidder: id_bidder,
              id_auction: id_auction,
              bid_value: bid_value,
            },
            success:function(response){
              currentBid.innerHTML = "Current bid:" + bid_value + "$";
              bidSucess.style.display = 'block';
            },
            error: function(response) {
              if(!id_bidder){
                bidOff.style.display = 'block';
              }
              console.log("error");
            },
      });
  });
