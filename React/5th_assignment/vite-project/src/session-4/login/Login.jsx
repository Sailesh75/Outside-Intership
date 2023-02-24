import React from "react";
import PasswordToggle from "./PasswordToggle";
import { Link, useNavigate } from "react-router-dom";
import { toast } from "react-toastify";

const Login = () => {
  const [PasswordInputType, ToggleIcon] = PasswordToggle();
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();
    let response = await fetch("http://localhost:8000/users");
    let users = await response.json();
    let enteredEmail = document.getElementById("email").value;
    let enteredPassword = document.getElementById("password").value;
    let candidateUser = users.find((user) => {
      return user.email == enteredEmail;
    });
    candidateUser && candidateUser.password == enteredPassword
      ? navigate("/dashboard")
      : toast.warning("Wrong Email or password.");
  };
  return (
    <>
      <div className="login">
        <div className="login_container">
          <figure>
            <img src="logo.png" alt="company_logo" />
          </figure>
          <p className="login_title">Dashboard Kit</p>
          <p className="login_text">Log In to Dashboard Kit</p>
          <p className="login_value">Enter your email and password</p>
          <div className="form">
            <form onSubmit={handleLogin}>
              <label htmlFor="email">Email</label>
              <br />
              <input
                type="text"
                id="email"
                name="email"
                placeholder="Email address"
                required
              />
              <br />
              <div style={{ marginTop: "2.4rem" }}>
                <label htmlFor="password">Password</label>
                <br />
                <input
                  type={PasswordInputType}
                  id="password"
                  name="password"
                  placeholder="Password"
                  required
                />
              </div>
              <span className="forgot-password">Forgot Password?</span>
              <span className="password-toggle-icon">{ToggleIcon}</span>
              <div style={{ marginBottom: "2.4rem" }}>
                <input type="checkbox" id="remember" name="remember" />
                <span style={{ marginLeft: "1.2rem", marginBottom: "0.3rem" }}>
                  <label htmlFor="remember">Remember Me</label>
                </span>
              </div>
              <input type="submit" value="Log in" />
            </form>
            <p>
              Don't have an account?{" "}
              <span className="sign-up">
                <Link to="/signup">Sign up</Link>
              </span>
            </p>
          </div>
        </div>
      </div>
    </>
  );
};

export default Login;
