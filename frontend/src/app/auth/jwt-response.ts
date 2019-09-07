export interface JwtResponse {
  user: {
    id: number,
    nom: string,
    username: string,
    access_token: string,
    expires_in: string
  }
}

