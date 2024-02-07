import type { EventType } from "@types/eventType";

export interface CategoryType {
  id: number;
  label: string;
}

export interface ArticleType {
  id: number;
  title: string;
  content: string;
  category?: CategoryType[];
  layout: {
    id: number;
    choice: number;
  }
  createdAt: string;
  event?: EventType[];
}