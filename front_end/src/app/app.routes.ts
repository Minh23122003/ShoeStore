import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { CartComponent } from './cart/cart.component';
import { ShoeDetailsComponent } from './shoe-details/shoe-details.component';
import { ReservingComponent } from './reserving/reserving.component';
import { RatingComponent } from './rating/rating.component';

export const routes: Routes = [
    {path: "", component: HomeComponent},
    {path: "login", component: LoginComponent},
    {path: "register", component: RegisterComponent},
    {path: "shoes/:id", component: ShoeDetailsComponent},
    {path: "shoes/:id/reserving", component: ReservingComponent},
    {path: "cart", component: CartComponent},
    {path: "cart/bills/:id/rating", component: RatingComponent},
];
