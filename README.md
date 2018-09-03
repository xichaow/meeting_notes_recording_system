# meeting_notes_recording_system
This is final assignment for kit405 Programming for Intelligent Web Services and Applications


# Topic
This application is about a meeting notes recording system, including some convenient functions for the users, such as finding car parking and where is user’s current location.
# Web Service (API)
The web speech API is the main function. Except it, there are another two API, Geolocation API and Place API. Geolocation API is to get the current location, while place API is to get nearby target place.
# Dialog Scripts
When the user start the system: User: hello
System: hello Larry
User: how are you
System: good thanks, how about you? User: show my location
System: let me show your location
User: show me parking place nearby System: let me show you nearby parking User: how about this meeting
System: is this meeting an urgent request from customer? If user says yes:
• System: this meeting will be difficult. You should fully prepare for it. If user says no:
• System: will you meet a new customer? o If user says yes:
▪ System: this meeting will be difficult. You should fully prepare for it.
o If user says no:
▪ System: it will be an easy meeting.
User: make a recording
System: what is the customer name you want to make recording for? User: let’s finish this meeting
System: What do you think of this meeting?
If user says positive feedback: I think this meeting is good
• System: thanks for the meeting. I will send those meeting notes.
If user says negative or neutral feedback: I think this meeting is good • System: could you please provide more feedbacks. Thanks.
User: goodbye System: see you later
If system can’t tell what user says, system will say: Sorry, Larry. I don't get what you said.
# AI Techniques Used
Based on user’s history with customer, decision tree is implemented to achieve the AI techniques. According to user’s answer, give prediction whether this meeting will be difficult or not and whether need to pay more attention.
# Past User’s Behavior Data
Past user data is to predict the difficulty of meeting. We have 4 attributes including difficulty. The other 3 attributes are urgency, customer level, and new customer (or not).
# Video Link
https://goo.gl/KBQnZw
