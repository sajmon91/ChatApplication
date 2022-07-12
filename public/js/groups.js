if (location.href.includes("http://localhost/webApplicationChat/groups/")) {
  const form = document.querySelector(".typing-area");
  const groupId = form.querySelector(".incoming_id").value;
  const inputField = form.querySelector(".input-field");
  const sendBtn = form.querySelector("button");
  const chatBox = document.querySelector(".chat-box");

  inputField.focus();
  inputField.addEventListener("keyup", () => {
    if (inputField.value != "") {
      sendBtn.classList.add("active");
    } else {
      sendBtn.classList.remove("active");
    }
  });

  // send message
  sendBtn.addEventListener("click", (e) => {
    e.preventDefault();

    let formData = new FormData(form);

    fetch("http://localhost/webApplicationChat/ajaxinsertgroupchat/", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error();
        }
        inputField.value = "";
        scrollToBottom();
      })
      .catch((err) => console.error(err));
  });

  chatBox.addEventListener("mouseenter", () => {
    chatBox.classList.add("active");
  });
  chatBox.addEventListener("mouseleave", () => {
    chatBox.classList.remove("active");
  });

  // load message
  setInterval(() => {
    const sendData = {
      groupId: groupId,
    };

    fetch("http://localhost/webApplicationChat/ajaxgetgroupchat", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(sendData),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error();
        }
        return response.text();
      })
      .then((data) => {
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      })
      .catch((err) => console.error(err));
  }, 500);

  function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
  }
}
