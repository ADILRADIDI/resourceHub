<template>
    <div class="chat-container">
      <div class="chat-header">
        <h2>Chat</h2>
      </div>
      <div class="chat-messages">
        <div class="message user-message">Hello, how are you?</div>
        <div class="message bot-message">I'm good, thank you! How can I assist you today?</div>
        <div class="message user-message">I need help with my account.</div>
      </div>
      <div class="chat-input">
        <input type="text" placeholder="Type a message..." />
        <button>Send</button>
      </div>
    </div>
  </template>
  
  <style scoped>
  .chat-container {
    display: flex;
    flex-direction: column;
    height: 500px;
    width: 400px;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
  }
  
  .chat-header {
    background-color: #007bff;
    color: white;
    padding: 10px;
    text-align: center;
  }
  
  .chat-messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    background-color: #f9f9f9;
  }
  
  .message {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    max-width: 80%;
  }
  
  .user-message {
    background-color: #d0f0c0;
    margin-left: auto;
    text-align: right;
  }
  
  .bot-message {
    background-color: #e0e0e0;
  }
  
  .chat-input {
    display: flex;
    padding: 10px;
    background-color: #fff;
    border-top: 1px solid #ddd;
  }
  
  input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  
  button {
    margin-left: 10px;
    padding: 10px 15px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  </style>
  