let isRecognitionActive = false;
let recognition = null;

function enableEdit() {
  const editableDiv = document.querySelector('#editable');
  editableDiv.contentEditable = true;
  editableDiv.style.background = 'rgba(0, 0, 0, 0.1)';

  const editButtonsDiv = document.querySelector('#editButtons');
  editButtonsDiv.style.display = 'block';
}

function toggleRecognition() {
  if (!isRecognitionActive) {
    recognition = new webkitSpeechRecognition();
    recognition.continuous = true;
    recognition.interimResults = true;
    recognition.onresult = event => {
      const transcript = event.results[event.results.length - 1][0].transcript;
      const editableDiv = document.querySelector('#editable');
      const isFinal = event.results[event.results.length - 1].isFinal;
      if (isFinal) {
        editableDiv.textContent += transcript;
      } else {
        const resultDiv = document.querySelector('#result');
        resultDiv.textContent = transcript;
      }
    }
    recognition.start();
  } else {
    recognition.stop();
  }
  isRecognitionActive = !isRecognitionActive;
  const toggleButton = document.querySelector('button[onclick="toggleRecognition()"]');
  toggleButton.textContent = isRecognitionActive ? 'Stop Speech Recognition' : 'Start Speech Recognition';
}

function saveChanges() {
  const editableDiv = document.querySelector('#editable');
  editableDiv.contentEditable = false;
  editableDiv.style.background = 'transparent';

  const editButtonsDiv = document.querySelector('#editButtons');
  editButtonsDiv.style.display = 'none';
}

function cancelEdit() {
  const editableDiv = document.querySelector('#editable');
  editableDiv.contentEditable = false;
  editableDiv.style.background = 'transparent';
  editableDiv.innerText = editableDiv.dataset.originalText;

  const editButtonsDiv = document.querySelector('#editButtons');
  editButtonsDiv.style.display = 'none';
}