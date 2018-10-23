// Create the Sapi SpVoice object
var VoiceObj = new ActiveXObject("Sapi.SpVoice");

//SetVoice() function:	This function sets the "Microsoft Simplified Chinese" voice from the Voice object.
//option: Microsoft Sam/Microsoft Mike/Microsoft Mary/Microsoft Simplified Chinese/Sample TTS Voice/VW Lily
function SetVoice() {
	var VoicesToken = VoiceObj.GetVoices();
	for( var i = 0; i < VoicesToken.Count; i++ )
	{
		var str = VoicesToken.Item(i).GetDescription();
		if(str.indexOf("Lily") != -1)
		{
			VoiceObj.Voice = VoiceObj.GetVoices().Item(i);
			return true;
		}
	}
	
	for( var i = 0; i < VoicesToken.Count; i++ )
	{
		var str = VoicesToken.Item(i).GetDescription();
		if(str.indexOf("Chinese") != -1)
		{
			VoiceObj.Voice = VoiceObj.GetVoices().Item(i);
			return true;
		}
	}

	alert("没有找到中文语音引擎！");
	delete VoiceObj;
	return false;
}

// SetAudioOutput() function: This function sets the audio output from the Voice object.
function SetAudioOutput() {
	var AudioOutputsToken = VoiceObj.GetAudioOutputs();
	for( var i = 0; i < AudioOutputsToken.Count; i++ )
	{
		var str = AudioOutputsToken.Item(i).GetDescription();
		if(str.length > 0)
		{
			VoiceObj.AudioOutput = VoiceObj.GetAudioOutputs().Item(i);
			return true;
		}
	}	
	alert("没有找到语音输出设备！");
	delete VoiceObj;
	return false;
}

// IncRate() function: This function increases the speaking rate by 1 up to a maximum of 10.
function IncRate() {
	if( VoiceObj.Rate < 10 )
	{
		VoiceObj.Rate = VoiceObj.Rate + 1;
	}
}

// DecRate() function: This function decreases the speaking rate by -1 down to a minimum of -10.
function DecRate() {
	if( VoiceObj.Rate > -10 )
	{
		VoiceObj.Rate = VoiceObj.Rate - 1;
	}
}

// IncVol() function: This function increases the speaking volume by 10 up to a maximum	of 100.
function IncVol() {
	if( VoiceObj.Volume < 100 )
	{
		VoiceObj.Volume = VoiceObj.Volume + 10;
	}
}

// DecVol() function: This function decreases the speaking volume by -10 down to a minimum of 0.
function DecVol() {
	if( VoiceObj.Volume > 9 )
	{
		VoiceObj.Volume = VoiceObj.Volume - 10;
	}
}

// BeginSpeakText() function: This function gets the text from the input parameter and sends it to the Voice object's Speak() function. 
//	The value "1" for the second parameter corresponds to the SVSFlagsAsync value in the SpeechVoiceSpeakFlags enumerated type.
function BeginSpeakText(WhatToSpeak) {
	try
	{
		VoiceObj.Speak( WhatToSpeak, 0 );
		//VoiceObj.Speak( document.getElementById("idTextBox").value, 1 );
	}
	catch(exception)
	{
		alert("语音播报错误！");
	}
}
// StopSpeakText() function: This function Speak empty string to Stop current speaking. 
//  The value "2" for the second parameter corresponds to the SVSFPurgeBeforeSpeak value in the SpeechVoiceSpeakFlags enumerated type.
function StopSpeakText() {
	try
	{
		VoiceObj.Speak( "", 2 );
	}
	catch(exception)
	{
		alert("语音播报停止错误！");
	}
}
