import { useState } from 'react';
import HttpService from "../services/http";

const LoginPage = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState(null);

  const handleSubmit = async (event) => {
    event.preventDefault();
    const httpService = new HttpService();

    try {
      const response = await httpService.post('login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: { username, password },
      });

      if (!response.status) {
        throw new Error('Login failed');
      }

      // Handle successful login (e.g., redirect to protected area)
      console.log('Login successful!');
      // You can use browser storage (localStorage or sessionStorage) 
      // to store a token or user information here
    } catch (error) {
      setError(error.message);
    }
  };

  return (
    <div>
      <h1>Login</h1>
      {error && <p className="error">{error}</p>}
      <form className="login-form" onSubmit={ handleSubmit }>
        <input
          type="email"
          name="username"
          value={username}
          onChange={(event) => setUsername(event.target.value)}
          placeholder='Enter your email'
          className='form-control'
          required
        />
        <input
          type="password"
          name="password"
          value={password}
          onChange={(event) => setPassword(event.target.value)}
          placeholder='Enter your password'
          className='form-control'
        />
        <button type="submit">Login</button>
      </form>
    </div>
  );
};

export default LoginPage;