<template>
  <div class="login-page">
    <div class="login-container">
      <section class="image-section">
        <img
          loading="lazy"
          src="https://cdn.builder.io/api/v1/image/assets/TEMP/b0181e9bc8d03d388b3d54bb666a72e655bf00dd6785b81910a9eb4c18dba411?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c"
          class="hero-image"
          alt="Login page hero image"
        />
      </section>
      <section class="form-section">
        <div class="login-form-container">
          <img
            loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/38c412ea277b59864db3cd4ed6a2d11a4c6887cadace8315a82a5e8fa3de3251?apiKey=8a1ef934bc6f454db56d3e8a4bd1613c"
            class="logo"
            alt="Company logo"
          />
          <h1 class="welcome-text">Welcome Back👋</h1>
          <form @submit.prevent="loginUser" class="login-form">
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input
                v-model="form.email"
                type="email"
                id="email"
                class="form-input"
                placeholder="yourname@example.com"
                required
              />
            </div>
            <div class="form-group">
              <label for="password" class="form-label">Password</label>
              <input
                v-model="form.password"
                type="password"
                id="password"
                class="form-input"
                placeholder="Password"
                required
              />
            </div>
            <button type="submit" class="login-button">Log In</button>
          </form>
          <div class="signup-prompt">
            <p class="prompt-text">Don't have an account?</p>
            <router-link to="/signup" class="signup-link"
              >Sign Up for free</router-link
            >
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async loginUser() {
      try {
        const response = await fetch("http://localhost:8000/api/users/login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: this.form.email,
            password: this.form.password,
          }),
        });

        if (!response.ok) {
          const errorMessage = await response.json();
          throw new Error(errorMessage.message || "Failed to login");
        }

        const userData = await response.json();
        // Assuming you store the token in localStorage for authentication
        localStorage.setItem("token", userData.token);

        // Redirect or navigate to another page, e.g., 'post' page
        this.$router.push("/");
      } catch (error) {
        console.error("Login error:", error);
        // Handle error display or notification to the user
      }
    },
  },
};
</script>

<style scoped>
.login-page {
  background-color: #fff;
  display: flex;
  flex-direction: column;
  margin-left: 5%;
  margin-right: 5%;
}

.login-container {
  display: flex;
}

.image-section {
  width: 600px;
  background: linear-gradient(143deg, #212529 53.74%, #73818f 81.86%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 80px 60px;
}

.hero-image {
  aspect-ratio: 0.93;
  object-fit: cover;
  width: 392px;
  margin-top: 222px;
  max-width: 100%;
}

.form-section {
  width: 36%;
  display: flex;
  flex-direction: column;
}

.login-form-container {
  display: flex;
  flex-direction: column;
  align-self: stretch;
  font-size: 20px;
  color: #212529;
  line-height: 1.4;
  margin: auto 0;
  padding: 0 20px;
}

.logo {
  width: 100px;
  max-width: 100%;
  aspect-ratio: 2;
  object-fit: contain;
}

.welcome-text {
  margin-top: 15px;
  font: 700 48px/1.1 Inter, sans-serif;
}

.login-form {
  margin-top: 51px;
}

.form-group {
  margin-bottom: 21px;
}

.form-label {
  display: block;
  font-family: Inter, sans-serif;
  font-weight: 700;
  line-height: 1.26;
  margin-bottom: 22px;
}

.form-input {
  width: 100%;
  font-family: Inter, sans-serif;
  border-radius: 5px;
  border: 1px solid #212529;
  background-color: #fff;
  color: rgba(0, 0, 0, 0.5);
  font-weight: 400;
  padding: 18px 24px;
}

.login-button {
  width: 100%;
  font-family: Inter, sans-serif;
  border-radius: 10px;
  background-color: #212529;
  color: #fff;
  font-weight: 600;
  text-align: center;
  line-height: 1.76;
  padding: 26px 60px;
  border: none;
  cursor: pointer;
  margin-top: 40px;
}

.signup-prompt {
  display: flex;
  margin-top: 22px;
  gap: 13px;
}

.prompt-text {
  font-family: Inter, sans-serif;
  font-weight: 400;
}

.signup-link {
  font-family: Inter, sans-serif;
  font-weight: 700;
  color: #212529;
  text-decoration: none;
}

@media (max-width: 991px) {
  .login-container {
    flex-direction: column;
    align-items: stretch;
    gap: 0;
  }

  .image-section,
  .form-section {
    width: 100%;
  }

  .image-section {
    margin-top: 40px;
    padding: 0 20px;
  }

  .hero-image {
    margin-top: 40px;
  }

  .login-form-container {
    margin-top: 40px;
  }

  .welcome-text {
    font-size: 40px;
  }

  .form-input,
  .login-button {
    padding-left: 20px;
    padding-right: 20px;
  }

  .signup-prompt {
    flex-wrap: wrap;
  }
}
</style>
