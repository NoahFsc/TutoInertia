export type Utilisateur = {
    id: number;
    name: string;
    email: string;
};

export type Auth = {
    user: Utilisateur | null;
};

export type Flash = {
    succes: string | null;
    erreur: string | null;
};
