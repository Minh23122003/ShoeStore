import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

export interface User{
  id: number,
  username: string,
  name: string,
  email: string,
  address: string,
  phone: string
}

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private urlApiLogin = "http://localhost:8000/api/login";
  private urlApiRegister = "http://localhost:8000/api/register";
  private urlApiProfile = "http://localhost:8000/api/profile";


  constructor(private http: HttpClient) { }

  login(formData: FormData): Observable<any>{
    return this.http.post<any>(this.urlApiLogin, formData);
  }

  register(formData: FormData): Observable<any>{
    return this.http.post<any>(this.urlApiRegister, formData);
  }

  profile(): Observable<User>{
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem("token")}`
    })

    return this.http.get<User>(this.urlApiProfile, {headers:headers});
  }

  isLogin(): boolean{
    return !!localStorage.getItem("token");
  }

  logout(): void{
    localStorage.removeItem("token");
  }
}
