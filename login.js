"use strict";

$(document).ready(() => {
  const emailPattern = /\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b/;

  // Focus to arrival date input box
  $("#email").focus();

  // Validate user information
  $("#login").submit((event) => {
    
    const email = $("#email").val().trim();
    const password = $("#password").val().trim();

    // Change span to no text if data is ok or error messages if data invalid
    if (email === "" || !emailPattern.test(email)) {
      $("#email").next("span").text("Please enter a valid email address");
    } else {
      $("#email").next("span").text("");
    }

    if (password === "") {
      $("#password").next("span").text("Please enter your password");
    } else {
      $("#password").next("span").text("");
    }

    //Prevent submission if data is invalid
    if (email === "" || !emailPattern.test(userEmail) || password === "") {
      event.preventDefault();
    };
  });
});