import {useEffect, useState} from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import './App.css';
import Navbar from './components/navbar';
import Home from './components/home';
import Login from './components/login';

// Placeholder for authentication state (replace with your logic)
const isLoggedIn = false; // Replace with actual authentication logic
function App() {
  const [loggedIn, setLoggedIn] = useState(isLoggedIn); // Initial state
    // Simulate authentication check on app load (replace with actual logic)
    useEffect(() => {
      // Check for stored tokens, session data, or user info to determine login state
      // setLoggedIn(true or false based on authentication check);
    }, []); // Empty dependency array to run only on initial render

    const handleLogin = () => {
      setLoggedIn(true); // Update state on successful login
    };

  return (
    <BrowserRouter>
        <div className="App">
        <Navbar />
        <div className="content">
        <Routes>
            <Route
              path="/login"
              element={!loggedIn ? <Login onLogin={handleLogin} /> : <Navigate to="/" replace />}
            />
            <Route path="/" element={loggedIn ? <Home /> : <Navigate to="/login" replace />} />
        </Routes>
        </div>
      </div>
    </BrowserRouter>
  );
}

export default App;
