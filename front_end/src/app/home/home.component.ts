import { Component, OnInit } from '@angular/core';
import { HeaderComponent } from '../header/header.component';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Category, Shoe, ShoesService } from '../services/shoes.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-home',
  imports: [HeaderComponent, FormsModule, CommonModule],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent implements OnInit{
  categories: Category[] = [];
  shoes: Shoe[] = [];
  selectedCategoryId: number = 0;
  selectedPrice: number = 0;
  searchName: string = "";
  currentPage: number = 1;
  totalPage: number = 1;

  constructor(private shoeService: ShoesService, private router: Router) {};

  ngOnInit(): void {
    this.shoeService.getCategories().subscribe({
      next: (res) => {
        this.categories = res;
      },
      error: (err) => {
        alert(err);
      }
    })
    this.getShoes(this.currentPage);
  }

  searchShoes(): void{
    this.getShoes(1);
  }

  goToNextPage(): void{
    this.getShoes(this.currentPage + 1);
  }

  goToPreviousPage(): void{
    this.getShoes(this.currentPage - 1);
  }

  getShoes(page: number): void{
    this.shoeService.getShoes(this.selectedCategoryId, this.searchName, this.selectedPrice, page).subscribe({
      next: (res) => {
        this.shoes = res.data;
        this.currentPage = res.current_page;
        this.totalPage = res.last_page;
      },
      error: (err) => {
        alert(err);
      }
    })
  }

  goToDetails(id: number): void{
    this.router.navigate(["shoes", id]);
  }

  goToReserving(id: number): void{
    this.router.navigate(["shoes", id, "reserving"]);
  }
}
