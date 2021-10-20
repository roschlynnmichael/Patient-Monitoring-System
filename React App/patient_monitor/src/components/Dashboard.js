import React, { useState , useEffect, Component } from "react"
import { useAuth } from "../contexts/AuthContext"
import { Link, useHistory } from "react-router-dom"

export default function Dashboard() {
  const [error, setError] = useState("")
  const { currentUser, logout } = useAuth()
  const history = useHistory()

  async function handleLogout() {
    setError("")

    try {
      await logout()
      history.push("/login")
    } catch {
      setError("Failed to log out")
    }
  }

  return (
<>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-gradient-primary">
      <a class="navbar-brand" href="#">Welcome</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <Link to='/update-profile'>
            <button class="btn btn-outline-success ml-2" type="submit">Update password</button>
          </Link>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" variant='link' onClick={handleLogout}>Logout</button>
        </ul>
      </div>
    </nav>
    <div className='table'>
      <table>
        <thead>
          <th>Bed Number</th>
          <th>Body Temperature</th>
          <th>Diastolic Pressure</th>
          <th>Pulse Rate</th>
          <th>Systolic Pressure</th>
        </thead>
        <tbody>
          <tr>
          </tr>
        </tbody>
      </table>
    </div>
</>
  )
}
