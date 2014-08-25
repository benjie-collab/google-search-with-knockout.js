/* --------------------------------------------------------
Chat
-----------------------------------------------------------*/


function chatModel() {
	 var self = this;	

	 self.chatToggled 		= ko.observable(false);
	 self.chatListToggled 	= ko.observable(false);

	 self.messageToAdd 		= ko.observable("");
     self.allMessages 		= ko.observableArray([{
													name: 'Karim',
													message: 'During interrogation,Ahmad revealed Rashid Muda as suspect, investigation is in progress ',
													time: 'Jan 10, 2014 03:45 AM',
													image: 'img/profile-pics/1.jpg'
													},
													{
													name: 'Irfan',
													message: 'Recovered their {mobile, Cash RM2,000,2 duplicate passport} on Dec 10, 2013 ',
													time: 'Dec 10, 2013 01:22 PM',
													image: 'img/profile-pics/2.jpg'
													},
													{
													name: 'Karim',
													message: 'Raid in Kuala Lumpur, arrested 4 guys : Abu, Ahmad, Syed and Yusuf on Dec 10, 2013 ',
													time: 'Dec 10, 2013 10:30 AM',
													image: 'img/profile-pics/1.jpg'
													}]); 
     self.selectedMessages 	= ko.observableArray([]);
	 
	 self.addMessage = function () {
        if ((this.messageToAdd() != "") && (this.allMessages.indexOf(this.messageToAdd()) < 0)) // Prevent blanks and duplicates
            this.allMessages.push({
				name	: 'Me',
				message : this.messageToAdd(),
				time  	: 'Just now',
				image	: 'img/profile-pics/3.jpg'
			});
        this.messageToAdd(""); // Clear the text box
     };
	
	 self.removeSelected = function () {
        this.allMessages.removeAll(this.selectedMessages());
        this.selectedMessages([]); // Clear selection
	 };	 
	 
	 
	 
	 self.chatListToggle 	= function(item, event){	
		self.chatListToggled((self.chatListToggled() === true)? false: true)
	 }
	 
	 self.chatToggle = function(item, event){
		self.chatListToggled(false)
		self.chatToggled((self.chatToggled() === true)? false: true)
		if($('#chat-content')[0]) {
				var overflowRegular, overflowInvisible = false;
				overflowRegular = $('#chat-content').niceScroll();
			}
	 }
	 
	 init : {
			
	 }
	 
 }
