const speakButton = document.getElementById("speak-button");
const textToSpeak = document.getElementById("text-to-speak");

speakButton.addEventListener("click", () => {
  const msg = new SpeechSynthesisUtterance();
  msg.text = textToSpeak.textContent;
  window.speechSynthesis.speak(msg);
});
