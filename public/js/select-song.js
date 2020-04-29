var player = new Vue({
	el: '#player',
  	data: {
    	playerUrl: '',
    	idsQueue: ''
  	},
  	computed: {
  		formedPlayerUrls: function () {
  			idsQueue = this.getIds();
  			var urlBegining = 'https://www.youtube.com/embed?listType=playlist&playlist=';

  			this.playerUrl = urlBegining.concat(idsQueue, '&version=3&autoplay=1&fs=0');
  			return this.playerUrl;
  		}
  	},
  	methods: {
  		getIds: function () {
  			this.idsQueue = document.getElementById('playlistQueue').value;

  			return this.idsQueue;
  		}
  	}
});

var changeSong = new Vue({
	el: '#playlist',
	data: {
		playerUrl: ''
	},
	methods: {
		changeIdsQueue: function (selectedId) {
  			var fullIdsQueue = player.idsQueue;
  			var pointer = fullIdsQueue.search(selectedId);
  			var currentQueue = fullIdsQueue.slice(pointer);
  			var urlBegining = 'https://www.youtube.com/embed?listType=playlist&playlist=';

  			this.playerUrl = urlBegining.concat(currentQueue, '&version=3&autoplay=1&fs=0');
  			player.playerUrl = this.playerUrl;

  			return this.playerUrl;
  		}
	}
});

player.formedPlayerUrls();