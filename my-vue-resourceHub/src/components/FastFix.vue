<template>
    <div class="chat-container">
      <div class="chat-header bg-gradient-to-r from-blue-300 to-blue-800">
        <h2 class="font-bold text-2xl text-white">GIVE ME YOUR ERROR FOR FAST FIX &#9749;</h2>
      </div>
      <div class="chat-messages">
        <div class="message user-message">
          <div class="message-content">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo beatae amet odio.
          </div>
          <img class="user-image border border-solid border-black" src="data:image/jpeg;base64,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" alt="User" />
        </div>
        <div class="message bot-message">
          <img class="bot-image p-1 border border-solid border-black"  src="https://uxwing.com/wp-content/themes/uxwing/download/web-app-development/div-coding-icon.png" alt="Bot" />
          <div class="message-content">
            I'm good, thank you! How can I assist you today?
          </div>
        </div>
      </div>
      <div class="chat-input bg-gray-100 rounded-full mx-8 my-5">
        <input type="text" placeholder="Your Error for Fast Fix . . . . ." />
        <button class="flex items-center justify-center rounded-full">
            <span class="material-symbols-outlined">
                send
            </span>
        </button>
      </div>
    </div>
  </template>
<style scoped>
.chat-container {
  display: flex;
  flex-direction: column;
  height: 550px; 
  width: 100%;
  max-width: 1200px; 
  margin: 20px auto;
  margin-top: 30px;
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added shadow for depth */
  background-color: #fff; /* White background for the chat container */
}

.chat-header {
  color: white;
  padding: 15px;
  text-align: center;
  border-bottom: 1px solid #ddd; /* Added bottom border */
}

.chat-messages {
  flex: 1;
  padding: 15px;
  overflow-y: auto;
}

.message {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  padding: 10px 15px;
  border-radius: 12px;
  max-width: 80%;
  line-height: 1.5;
  font-size: 1rem;
  position: relative;
}

.user-message {
  margin-left: auto;
  justify-content: flex-end;
}

.bot-message {
  justify-content: flex-start;
}

.user-image, .bot-image {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  margin-left: 10px;
}

.bot-image {
  margin-right: 10px;
}

.message-content {
  background-color: transparent; /* No background color for messages */
  padding: 10px;
  border-radius: 12px;
  font-size: 1rem;
}

.chat-input {
  display: flex;
  padding: 10px;
}

input {
  flex: 1;
  padding: 10px;
  border: none; /* Remove border */
  outline: none; /* Remove outline */
  background-color: transparent; /* No background color */
  font-size: 1rem;
  color: #333; /* Text color */
}

input::placeholder {
  color: #888; /* Placeholder text color */
  font-size: 1rem;
}

button {
  margin-left: 10px;
  padding: 10px 20px;
  border: none;
  background-color: #000; /* Black button */
  color: white;
  cursor: pointer;
  font-size: 1rem;
}

button:hover {
  background-color: #333; /* Darker shade on hover */
}
</style>
  